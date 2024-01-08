<?php

namespace App\Http\Controllers;

use App\Models\TagihanKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTagihanKendaraan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanBB = DB::table('tagihan_kendaraan')
            ->leftJoin('data_stnk', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
            ->select('tagihan_pbb.id', 'data_pbb.nop', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
            ->get();

        $tagihanKendaraanList = TagihanKendaraan::all();
        return response()->json($tagihanKendaraanList, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_stnk' => 'required',
            'nominal_swdkllj' => 'required',
            'nominal_pkb' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $tagihanKendaraan = TagihanKendaraan::create($validatedData);

        return response()->json($tagihanKendaraan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TagihanKendaraan $tagihanKendaraan)
    {
        return response()->json($tagihanKendaraan, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TagihanKendaraan $tagihanKendaraan)
    {
        $validatedData = $request->validate([
            'id_stnk' => 'nullable',
            'id_alamat' => 'nullable',
            'nominal_swdkllj' => 'nullable',
            'nominal_pkb' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        $tagihanKendaraan->update($validatedData);

        return response()->json($tagihanKendaraan, 200);
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
