<?php

namespace App\Http\Controllers;

use App\Models\DataTagihan;
use App\Models\TagihanTerdaftar;
use App\Models\TagihanTersedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TagihanTersediaController extends Controller
{
    public function showAll()
    {
        $tagihanTersedia = TagihanTersedia::where('id_user', auth()->user()->id)
            ->whereIn('status', ['Belum Lunas', 'Denda'])
            ->orderBy('waktu_tenggat', 'asc')
            ->get();

        foreach ($tagihanTersedia as $tagihan) {
            $tagihan->nominal_tagihan = (int) $tagihan->nominal_tagihan;
            $tagihan->id_user = (int) $tagihan->id_user;
            $tagihan->id_tagihan_terdaftar = (int) $tagihan->id_tagihan_terdaftar;
        }

        return response()->json([
            'data' => $tagihanTersedia,
            'message' => 'Data Tagihan Tersedia berhasil diambil'
        ], 200);
    }

    public function store()
    {
        $dataTagihans = DataTagihan::orderBy('waktu_tenggat', 'asc')->get();

        $today = Carbon::now();

        foreach ($dataTagihans as $dataTagihan) {
            $waktuBisaBayar = Carbon::parse($dataTagihan->waktu_bisa_bayar);
            $waktuTenggat = Carbon::parse($dataTagihan->waktu_tenggat);

            if ($today->between($waktuBisaBayar, $waktuTenggat)) {
                foreach ($dataTagihans as $dataTagihan) {

                    $tagihanTerdaftars = TagihanTerdaftar::where('id_user', auth()->user()->id)->get();

                    $responses = [];

                    foreach ($tagihanTerdaftars as $tagihanTerdaftar) {
                        $yearNow = Carbon::now()->year;

                        $bulanBayar = $tagihanTerdaftar->bulan_bayar ?? Carbon::now()->month;

                        $waktu_bayar = Carbon::create(
                            $yearNow, 
                            $bulanBayar, 
                            $tagihanTerdaftar->tanggal_bayar, 
                            0, 0, 0
                        );

                        if ($waktu_bayar->lt($dataTagihan->waktu_bisa_bayar)) {
                            $waktu_bayar->addYear();
                        }

                        $existingTagihanTersedia = TagihanTersedia::where('no_tagihan', $tagihanTerdaftar->no_tagihan)->first();

                        if (!$existingTagihanTersedia) {
                            $response = auth()->user()->tagihanTersedia()->create([
                                'id_tagihan_terdaftar' => $tagihanTerdaftar->id,
                                'jenis_tagihan' => $tagihanTerdaftar->jenis_tagihan,
                                'no_tagihan' => $tagihanTerdaftar->no_tagihan,
                                'nama_tagihan' => $tagihanTerdaftar->nama_tagihan,
                                'nominal_tagihan' => $dataTagihan->nominal_tagihan,
                                'waktu_bayar' => $waktu_bayar,
                                'waktu_tenggat' => $dataTagihan->waktu_tenggat,
                                'status' => 'Belum Lunas',
                            ]);

                            $responses[] = $response;
                        }
                    }

                    if (!empty($responses)) {
                        return response()->json([
                            'data' => $responses,
                            'message' => 'Tagihan Tersedia berhasil terdaftar'
                        ], 201);
                    }
                }
            }
        }
    }

    public function showTotalTagihan()
    {
        $totalTagihan = TagihanTersedia::where('id_user', auth()->user()->id)
            ->sum('nominal_tagihan');

        return response()->json([
            'total' => $totalTagihan,
            'message' => 'Total tagihan berhasil diambil'
        ], 200);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'waktu_bayar' => 'required|date',
        ]);

        $tagihanTersedia = TagihanTersedia::where('id_user', auth()->user()->id)
            ->where('id', $id)
            ->first();

        $tagihanTersedia->update([
            'waktu_bayar' => $request->waktu_bayar,
        ]);

        return response()->json([
            'data' => $tagihanTersedia,
            'message' => 'Jadwal pembayaran berhasil diupdate'
        ], 200);
    }
}
