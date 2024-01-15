<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagihanTerdaftarRequest;
use App\Models\DataPBB;
use App\Models\DataPGN;
use App\Models\DataPLN;
use App\Models\TagihanTerdaftar;
use Illuminate\Http\Request;

class TagihanTerdaftarController extends Controller
{
    function storePBB (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPBB = DataPBB::where('nop', $request->no_tagihan)->first();

        if (!$dataPBB) {
            return response()->json(['error' => 'No tagihan does not match NOP in data_pbb table'], 400);
        }

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $request->no_tagihan,
            'jenis_tagihan' => 'PBB',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
        ]);

        return response()->json([
            $response,
            'message' => 'Tagihan PBB berhasil terdaftar'
        ], 201);
    }

    function storePLN (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPLN = DataPLN::where('id_pelanggan', $request->no_tagihan)->first();

        if (!$dataPLN) {
            return response()->json(['error' => 'No tagihan does not match ID Pelanggan in data_pln table'], 400);
        }

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $request->no_tagihan,
            'jenis_tagihan' => 'PLN',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
        ]);

        return response()->json([
            $response,
            'message' => 'Tagihan PLN berhasil terdaftar'
        ], 201);
    }

    function storePGN (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPGN = DataPGN::where('no_pelanggan', $request->no_tagihan)->first();

        if (!$dataPGN) {
            return response()->json(['error' => 'No tagihan does not match ID Pelanggan in data_pgn table'], 400);
        }

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $request->no_tagihan,
            'jenis_tagihan' => 'PGN',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
        ]);

        return response()->json([
            $response,
            'message' => 'Tagihan PGN berhasil terdaftar'
        ], 201);
    }
}
