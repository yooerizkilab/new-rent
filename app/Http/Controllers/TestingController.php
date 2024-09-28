<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Item;

class TestingController extends Controller
{
    public function index()
    {
        $histories = History::all();

        return view('backend.testing.index', compact('histories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        // $request->validate([
        //     'jumlah' => 'required|string',
        //     'proyek' => 'required|string|size:12',
        // ]);

        // Cari item berdasarkan QR code
        $item = Item::where('no_seri', $request->qr_code)->first();

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
}
