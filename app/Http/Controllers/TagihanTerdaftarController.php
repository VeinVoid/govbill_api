<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagihanTerdaftarRequest;
use App\Models\DataBPJS;
use App\Models\DataNIK;
use App\Models\DataPBB;
use App\Models\DataPDAM;
use App\Models\DataPGN;
use App\Models\DataPLN;
use App\Models\DataSTNK;
use App\Models\TagihanTerdaftar;
use Illuminate\Http\Request;

class TagihanTerdaftarController extends Controller
{
    public function showAll()
    {
        $tagihanTerdaftar = auth()->user()->tagihanTerdaftar()->get();

        foreach ($tagihanTerdaftar as $tagihan) {
            $tagihan->id_user = (int) $tagihan->id_user;
            $tagihan->nominal_tagihan = (int) $tagihan->nominal_tagihan;
            $tagihan->tanggal_bayar = (int) $tagihan->tanggal_bayar;
            $tagihan->bulan_bayar = (int) $tagihan->bulan_bayar;
        }

        return response()->json([
            'data' => $tagihanTerdaftar
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_tagihan' => 'required|string',
            'tanggal_bayar' => 'required|string',
            'bulan_bayar' => 'string',
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

    public function storePBB (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataPBB = DataPBB::where('nop', $request->no_tagihan)
            ->where('kota_kabupaten', $request->kota_kabupaten)
            ->first();

        $nop = DataPBB::where('nop', $request->no_tagihan)->first();
        $kota_kabupaten = DataPBB::where('kota_kabupaten', $request->kota_kabupaten)->first();

        if (!$nop) {
            return response()->json(['message' => 'NOP Tidak Ditemukan'], 400);
        }

        if (!$kota_kabupaten) {
            return response()->json(['message' => 'Kota/Kabupaten Tidak Ditemukan'], 400);
        }

        if (!$dataPBB) {
            return response()->json(['message' => 'Tidak Ditemukan Data Yang Sesua'], 400);
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
            return response()->json(['message' => 'ID Pelanggan Tidak Ditemukan'], 400);
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
            return response()->json(['message' => 'ID Pelanggan Tidak Ditemukan'], 400);
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

        $no_pelanggan = DataPDAM::where('no_pelanggan', $request->no_tagihan)->first();
        $kota_kabupaten = DataPDAM::where('kota_kabupaten', $request->kota_kabupaten)->first();

        if (!$no_pelanggan) {
            return response()->json(['message' => 'No Pelanggan Tidak Ditemukan'], 400);
        }

        if (!$kota_kabupaten) {
            return response()->json(['message' => 'Kota/Kabupaten Tidak Ditemukan'], 400);
        }

        if (!$dataPDAM) {
            return response()->json(['message' => 'Tidak Ditemukan Data Yang Sesuai'], 400);
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
            return response()->json(['message' => 'No VA Tidak Ditemukan'], 400);
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

    public function verifikasiKendaraan(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nrkb' => 'required|string',
        ]);

        $dataSTNK = DataSTNK::where('nik', $request->nik)
            ->where('nrkb', $request->nrkb)
            ->first();

        $nik = DataSTNK::where('nik', $request->nik)->first();
        $nrkb = DataSTNK::where('nrkb', $request->nrkb)->first();

        if (!$nik) {
            return response()->json(['message' => 'NIK Tidak Ditemukan'], 400);
        }

        if (!$nrkb) {
            return response()->json(['message' => 'NRKB Tidak Ditemukan'], 400);
        }

        if (!$dataSTNK) {
            return response()->json(['message' => 'NIK ' . $request->nik . ' tidak memiliki kendaraan dengan NRKB ' . $request->nrkb], 400);
        }

        return response()->json([
            'data' => $dataSTNK,
            'message' => 'Data STNK berhasil diverifikasi'
        ], 200);
    }

    public function storeMotor (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataSTNK = DataSTNK::where('nik', $request->nik)
            ->where('nrkb', $request->nrkb)
            ->first();

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $dataSTNK->nrkb,
            'jenis_tagihan' => 'Motor',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
            'id_stnk' => $dataSTNK->id,
            'id_alamat' => $request->id_alamat,
        ]);

        return response()->json([
            'data' => $response,
            'message' => 'Tagihan Motor berhasil terdaftar'
        ], 201);
    }

    public function storeMobil (TagihanTerdaftarRequest $request) 
    {
        $request->validated();

        $dataSTNK = DataSTNK::where('nik', $request->nik)
            ->where('nrkb', $request->nrkb)
            ->first();

        $response = auth()->user()->tagihanTerdaftar()->create([
            'no_tagihan' => $dataSTNK->nrkb,
            'jenis_tagihan' => 'Mobil',
            'nama_tagihan' => $request->nama_tagihan,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bulan_bayar' => $request->bulan_bayar,
            'id_stnk' => $dataSTNK->id,
            'id_alamat' => $request->id_alamat,
        ]);

        return response()->json([
            'data' => $response,
            'message' => 'Tagihan Mobil berhasil terdaftar'
        ], 201);
    }
}
