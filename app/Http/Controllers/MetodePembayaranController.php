<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodePembayaranRequest;
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

    public function storeKartu(MetodePembayaranRequest $request)
    {
        $request->validated();

        $dataKartu = DataKartu::where($request->all())->first();

        $otherMetodePembayaran = auth()->user()->metodePembayaran()->count();

        $pembayaran_utama = false;

        if ($otherMetodePembayaran == 0) {
            $pembayaran_utama = true;
        } else {
            $pembayaran_utama = false;
        }

        $response = auth()->user()->metodePembayaran()->create([
            'jenis' => $dataKartu->jenis_kartu,
            'nomor' => $dataKartu->no_kartu,
            'nama' => $dataKartu->nama_pemilik,
            'saldo' => $dataKartu->saldo,
            'pembayaran_utama' => $pembayaran_utama,
        ]);
        
        return response()->json([
            'data' => $response,
            'message' => 'Metode pembayaran berhasil ditambahkan'
        ], 201);
    }
}
