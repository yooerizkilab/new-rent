<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Item;
use App\Models\User;
use App\Notifications\InvoicePaid;
use App\Services\SAPService;

class TestingController extends Controller
{
    protected $sapService;

    public function __construct(SAPService $sapService)
    {
        $this->middleware('auth');
        $this->sapService = $sapService;
    }

    public function index()
    {
        $item = Item::all();
        $histories = History::all();

        return view('backend.testing.index', compact('histories', 'item'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        // $request->validate([
        //     'jumlah' => 'required|string',
        //     'proyek' => 'required|string|size:12',
        // ]);

        // Cari item berdasarkan QR code
        $item = Item::where('code', $request->qr_code)->first();

        if ($item) {
            // Jika item ditemukan, simpan data ke tabel history
            $history = new History();
            $history->id_user = $request->id_user;
            $history->id_item = $item->id;
            $history->nama_user = $request->nama_user;
            $history->no_tlpn_user = $request->no_tlpn_user;
            $history->nama_item = $item->nama;
            $history->satuan_item = $item->satuan;
            $history->jenis_item = $item->jenis;
            $history->lokasi = $request->lokasi;
            $history->proyek = $request->proyek;
            $history->jumlah = $request->jumlah;
            $history->save();

            return response()->json(['success' => true, 'message' => 'Item ditemukan.']);
        } else {
            // Jika item tidak ditemukan
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }
    }

    public function imporPdf()
    {
        return view('backend.testing.impor-pdf');
    }

    public function imporExcel()
    {
        return view('backend.testing.impor-excel');
    }

    private function generateData()
    {
        // Simulasi data
        $data = [];
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'id' => $i,
                'qr_code' => 'QR Code ' . $i,
                'nama' => 'Item ' . $i,
                'satuan' => 'Satuan ' . $i,
                'jenis' => 'Jenis ' . $i,
                'lokasi' => 'Lokasi ' . $i,
                'proyek' => 'Proyek ' . $i,
                'jumlah' => $i,
            ];
        }

        return $data;
    }

    public function sendNotification()
    {
        // Temukan user yang akan dikirimi notifikasi
        $user = User::find(1); // Misalnya user dengan ID 1

        // Kirim notifikasi ke user
        $user->notify(new InvoicePaid());

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Notifikasi berhasil dikirim!');
    }
    // $endpoint = '$crossjoin(Orders,SalesPersons,PaymentTermsTypes)';
    // $param = [
    //     '$expand' => 'Orders($select=DocEntry,DocNum,DocDate,CardCode,CardName,NumAtCard,Comments,DocTotal,SalesPersonCode,FederalTaxID,DocTime),SalesPersons($select=SalesEmployeeCode,SalesEmployeeName),PaymentTermsTypes($select=GroupNumber,PaymentTermsGroupName)',
    //     '$filter' => 'Orders/SalesPersonCode eq SalesPersons/SalesEmployeeCode and Orders/PaymentGroupCode eq PaymentTermsTypes/GroupNumber and Orders/DocDate gt \'2024-06-30\' and Orders/CancelStatus eq \'csNo\'',
    //     '$orderby' => 'Orders/DocEntry desc'
    // ];
    public function getCustomers()
    {

        $endpoint = 'BusinessPartners';
        $param = [
            '$select' => 'CardCode,CardName',  // Field yang ingin dipilih
        ];
        $response = $this->sapService->get($endpoint, $param);

        return view('backend.testing.index', compact('customers'));
    }

    public function getCustomersId()
    {
        $id = 'VL00000116'; // asumsi get data by id parameter
        $endpoint = 'BusinessPartners';
        $param = [
            '$select' => 'CardCode,CardName',  // Field yang ingin dipilih
        ];

        // Mengambil data dari servis
        $response = $this->sapService->getById($endpoint, $id, $param);
        $customersId = $response;

        return $customersId;
        return view('backend.testing.index', compact('customersId'));
    }

    public function logout()
    {
        try {
            // Memanggil fungsi logout dari service
            $this->sapService->logout();
            // response()->json(['message' => 'Logout berhasil dari SAP B1'], 200);
            return redirect()->back()->with('success', 'Logout berhasil dari SAP B1');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal logout dari SAP B1', 'error' => $e->getMessage()], 500);
        }
    }
}
