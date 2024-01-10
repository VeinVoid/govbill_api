<?php

namespace App\Http\Controllers;

use App\Models\TagihanKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTagihanKendaraan extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanKendaraan = DB::table('tagihan_kendaraan')
            ->leftJoin('data_stnk', 'tagihan_kendaraan.id_stnk', '=', 'data_stnk.id_stnk')
            ->leftJoin('alamat', 'tagihan_kendaraan.id_alamat', '=', 'alamat.id_alamat')
            ->leftJoin('data_nik', 'tagihan_kendaraan.id_nik', '=', 'data_nik.id_nik')
            ->select('tagihan_kendaraan.id', 'data_stnk.no_rangka', 'data_stnk.nama_pemilik', 'data_stnk.nrkb', 'data_nik.no_nik', 'alamat.nama_penerima', 'alamat.no_hp', 'alamat.label_alamat', 'alamat.alamat_lengkap', 'tagihan_kendaraan.nominal_swdkllj', 'tagihan_kendaraan.nominal_pkb', 'tagihan_kendaraan.waktu_pembayaran', 'data_stnk.nrkb', 'tagihan_kendaraan.waktu_pembayaran', 'tagihan_kendaraan.waktu_tenggat')
            ->get();

        return $this->showResponse($tagihanKendaraan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nik = DB::table('data_nik')
            ->where('no_nik', $request->input('nik'))
            ->value('id_nik');
        
        $nrkb = DB::table('data_stnk')
            ->where('nrkb', $request->input('nrkb'))
            ->value('id_stnk');

        $validatedData = $request->validate([
            'id_nik' => 'nullable',
            'id_alamat' => 'required',
            'id_stnk' => 'nullable',
            'nominal_swdkllj' => 'required',
            'nominal_pkb' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['id_nik'] = $nik;

        $validatedData['id_stnk'] = $nrkb;

        $tagihanKendaraan = TagihanKendaraan::create($validatedData);

        return $this->showResponse($tagihanKendaraan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $nik = DB::table('data_nik')
            ->where('no_nik', $request->input('nik'))
            ->value('id_nik');
            
        $nrkb = DB::table('data_stnk')
            ->where('nrkb', $request->input('nrkb'))
            ->value('id_stnk');

        $tagihanKendaraan = DB::table('tagihan_kendaraan')
            ->leftJoin('data_stnk', 'tagihan_kendaraan.id_stnk', '=', 'data_stnk.id_stnk')
            ->leftJoin('alamat', 'tagihan_kendaraan.id_alamat', '=', 'alamat.id_alamat')
            ->leftJoin('data_nik', 'tagihan_kendaraan.id_nik', '=', 'data_nik.id_nik')
            ->where('tagihan_kendaraan.id_nik', '=', $nik)
            ->where('data_stnk.id_stnk', '=', $nrkb)
            ->select('tagihan_kendaraan.id', 'data_stnk.no_rangka', 'data_stnk.nama_pemilik', 'alamat.nama_penerima', 'alamat.no_hp', 'alamat.label_alamat', 'alamat.alamat_lengkap', 'tagihan_kendaraan.nominal_swdkllj', 'tagihan_kendaraan.nominal_pkb', 'tagihan_kendaraan.waktu_pembayaran', 'data_stnk.nrkb', 'tagihan_kendaraan.waktu_pembayaran', 'tagihan_kendaraan.waktu_tenggat')
            ->get();

        if (!$tagihanKendaraan) {
            return $this->notFoundResponse("Tagihan Kendaraan dengan no nik '{$request->input('nik')}' dan dengan nrkb '{$request->input('nrkb')}' tidak ditemukan.");
        }

        return $this->storeResponse($tagihanKendaraan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $nik = DB::table('data_nik')
            ->where('no_nik', $request->input('nik'))
            ->value('id_nik');

        $nrkb = DB::table('data_stnk')
            ->where('nrkb', $request->input('nrkb'))
            ->value('id_stnk');

        $tagihanKendaraan = TagihanKendaraan::where('id_nik', $nik)
            ->where('id_stnk', $nrkb)
            ->first();

        if (!$tagihanKendaraan) {
            return $this->notFoundResponse("Tagihan Kendaraan dengan no nik '{$request->input('nik')}' dan dengan nrkb '{$request->input('nrkb')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_nik' => 'nullable',
            'id_alamat' => 'nullable',
            'id_stnk' => 'nullable',
            'nominal_swdkllj' => 'nullable',
            'nominal_pkb' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        $tagihanKendaraan->update($validatedData);

        return $this->updateResponse($tagihanKendaraan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanKendaraan $tagihanKendaraan)
    {
        $tagihanKendaraan->delete();

        return response()->json(null, 204);
    }
}
