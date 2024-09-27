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
        $request->validate([
            'id_user' => 'required|integer',
            'qr_code' => 'required|string',
            'lokasi' => 'required|string',
            'nama_user' => 'required|string',
            'no_tlpn_user' => 'required|string',
            'proyek' => 'required|string'
        ]);

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
            $history->jenis_item = $item->jenis;
            $history->lokasi = $request->lokasi;
            $history->proyek = $request->proyek;
            $history->save();

            return response()->json(['success' => true, 'message' => 'Item ditemukan.']);
        } else {
            // Jika item tidak ditemukan
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }
    }
}
