<?php

namespace App\Http\Controllers;

use App\Models\DataKartu;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $metodePembayaran = MetodePembayaran::all();
        return response()->json([
            'data' => $metodePembayaran
        ], 200);
    }

    public function storeKartu(Request $request)
    {
        $request->validate([
            'no_kartu' => 'required|string',
            'bulan_berlaku' => 'required|string',
            'tahun_berlaku' => 'required|string',
            'cvv' => 'required|string',
        ]);

        $dataKartu = DataKartu::where($request->all())->first();

        $response = auth()->user()->metodePembayaran()->create([
            'jenis' => $dataKartu->jenis_kartu,
            'nomor' => $dataKartu->no_kartu,
            'nama' => $dataKartu->nama_pemilik,
            'saldo' => $dataKartu->saldo,
        ]);
        
        return response()->json([
            'data' => $response,
            'message' => 'Metode pembayaran berhasil ditambahkan'
        ], 201);
    }
}
