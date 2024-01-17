<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagihanTerdaftarRequest;
use App\Models\DataBPJS;
use App\Models\DataPBB;
use App\Models\DataPDAM;
use App\Models\DataPGN;
use App\Models\DataPLN;
use App\Models\TagihanTerdaftar;
use Illuminate\Http\Request;

class TagihanTerdaftarController extends Controller
{
    public function index()
    {
        $tagihanTerdaftar = auth()->user()->tagihanTerdaftar()->get();
        return response()->json([
            'data' => $tagihanTerdaftar
        ], 200);
    }

    public function storePBB (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPBB = DataPBB::where('nop', $request->no_tagihan)
            ->where('kota_kabupaten', $request->kota_kabupaten)
            ->first();

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
            'data' => $response,
            'message' => 'Tagihan PBB berhasil terdaftar'
        ], 201);
    }

    public function storePLN (TagihanTerdaftarRequest $request) 
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
            'data' => $response,
            'message' => 'Tagihan PLN berhasil terdaftar'
        ], 201);
    }

    public function storePGN (TagihanTerdaftarRequest $request) 
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
            'data' => $response,
            'message' => 'Tagihan PGN berhasil terdaftar'
        ], 201);
    }

    public function storePDAM (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPDAM = DataPDAM::where('no_pelanggan', $request->no_tagihan)
            ->where('kota_kabupaten', $request->kota_kabupaten)
            ->first();

        if (!$dataPDAM) {
            return response()->json(['error' => 'No tagihan does not match No Pelanggan in data_pdam table'], 400);
        }

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $request->no_tagihan,
            'jenis_tagihan' => 'PDAM',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
        ]);

        return response()->json([
            'data' => $response,
            'message' => 'Tagihan PDAM berhasil terdaftar'
        ], 201);
    }

    public function storeBPJS (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataBPJS = DataBPJS::where('no_va', $request->no_tagihan)->first();

        if (!$dataBPJS) {
            return response()->json(['error' => 'No tagihan does not match No VA in data_bpjs table'], 400);
        }

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $request->no_tagihan,
            'jenis_tagihan' => 'BPJS',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
        ]);

        return response()->json([
            'data' => $response,
            'message' => 'Tagihan BPJS berhasil terdaftar'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_bayar' => 'required|string',
            'bulan_bayar' => 'required|string',
        ]);

        $tagihanTerdaftar = auth()->user()->tagihanTerdaftar()->get()->find($id);

        $tagihanTerdaftar->update($validatedData);

        return response()->json([
            'data' => $tagihanTerdaftar,
            'message' => 'Tagihan terdaftar berhasil diupdate'
        ], 200);
    }

    public function destroy($id)
    {
        $tagihanTerdaftar = auth()->user()->tagihanTerdaftar()->get()->find($id);

        $tagihanTerdaftar->delete();

        $tagihanTersedia = auth()->user()->tagihanTersedia()->where('id_tagihan_terdaftar', $id)->first();

        $tagihanTersedia->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
