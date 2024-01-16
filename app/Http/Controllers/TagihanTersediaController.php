<?php

namespace App\Http\Controllers;

use App\Models\DataTagihan;
use App\Models\TagihanTerdaftar;
use App\Models\TagihanTersedia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagihanTersediaController extends Controller
{
    public function index()
    {
        $tagihanTersedias = TagihanTersedia::where('id_user', auth()->user()->id)
            ->orderBy('waktu_tenggat', 'asc')
            ->get();

        return response()->json([
            'data' => $tagihanTersedias,
            'message' => 'Data Tagihan Tersedia berhasil diambil'
        ], 200);
    }

    public function store()
    {
        $dataTagihans = DataTagihan::orderBy('waktu_tenggat', 'asc')->get();

        foreach ($dataTagihans as $dataTagihan) {

            $tagihanTerdaftars = TagihanTerdaftar::where('no_tagihan', $dataTagihan->no_tagihan)->first();

            $yearNow = Carbon::now()->year;

            $bulanBayar = $tagihanTerdaftars->bulan_bayar ?? Carbon::now()->month;

            $waktu_bayar = Carbon::create(
                $yearNow, 
                $bulanBayar, 
                $tagihanTerdaftars->tanggal_bayar, 
                0, 0, 0
            );

            if ($waktu_bayar->lt($dataTagihan->waktu_bisa_bayar)) {
                $waktu_bayar->addYear();
            }
            
            $response = auth()->user()->tagihanTersedia()->create([
                'id_tagihan_terdaftar' => $tagihanTerdaftars->id,
                'jenis_tagihan' => $tagihanTerdaftars->jenis_tagihan,
                'no_tagihan' => $tagihanTerdaftars->no_tagihan,
                'nama_tagihan' => $tagihanTerdaftars->nama_tagihan,
                'nominal_tagihan' => $dataTagihan->nominal_tagihan,
                'waktu_bayar' => $waktu_bayar,
                'waktu_tenggat' => $dataTagihan->waktu_tenggat,
            ]);

            return response()->json([
                'data' => $response,
                'message' => 'Tagihan Tersedia berhasil terdaftar'
            ], 201);
        }
    }
}
