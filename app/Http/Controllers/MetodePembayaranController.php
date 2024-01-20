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

    public function showAll()
    {
        $metodePembayaran = auth()->user()->metodePembayaran()->get();
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

    public function changePembayaranUtama($id) 
    {
        $metodePembayaran = auth()->user()->metodePembayaran()->findOrFail($id);

        $otherMetodePembayaran = auth()->user()->metodePembayaran()->where('pembayaran_utama', true)->first();

        if ($otherMetodePembayaran) {
            $otherMetodePembayaran->update([
                'pembayaran_utama' => false
            ]);
        }

        $metodePembayaran->update([
            'pembayaran_utama' => true
        ]);

        return response()->json([
            'data' => $metodePembayaran,
            'message' => 'Metode pembayaran utama berhasil diubah'
        ], 200);
    }

    public function destroy($id)
    {
        $metodePembayaran = auth()->user()->metodePembayaran()->findOrFail($id);

        if ($metodePembayaran->pembayaran_utama) {
            $otherMetodePembayaran = auth()->user()->metodePembayaran()->where('id', '!=', $id)->first();

            if ($otherMetodePembayaran) {
                $otherMetodePembayaran->update([
                    'pembayaran_utama' => true
                ]);
            }
        }

        $metodePembayaran->delete();

        return response()->json([
            'message' => 'Metode pembayaran berhasil dihapus'
        ], 200);
    }
}
