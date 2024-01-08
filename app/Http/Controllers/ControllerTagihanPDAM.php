<?php

namespace App\Http\Controllers;

use App\Models\TagihanPDAM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTagihanPDAM extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanPDAM = DB::table('tagihan_pdam')
            ->leftJoin('data_pdam', 'tagihan_pdam.id_pdam', '=', 'data_pdam.id_pdam')
            ->select('tagihan_pdam.id', 'data_pdam.no_pelanggan', 'data_pdam.nama_pelanggan', 'tagihan_pdam.waktu_pembayaran', 'tagihan_pdam.waktu_tenggat')
            ->get();

        return $this->showResponse($tagihanPDAM);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pdam = DB::table('data_pdam')
            ->where('no_pelanggan', $request->input('no_pelanggan'))
            ->value('id_pdam');

        if (!$id_pdam) {
            return $this->notFoundResponse("Tagihan PDAM dengan no pelanggan '{$request->input('no_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pdam' => 'nullable',
            'tagihan' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['id_pdam'] = $id_pdam;

        $tagihanPDAM = TagihanPDAM::create($validatedData);

        return $this->storeResponse($tagihanPDAM);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tagihanPDAM = DB::table('tagihan_pdam')
            ->leftJoin('data_pdam', 'tagihan_pdam.id_pdam', '=', 'data_pdam.id_pdam')
            ->select('tagihan_pdam.id', 'data_pdam.no_pelanggan', 'data_pdam.nama_pelanggan', 'tagihan_pdam.waktu_pembayaran', 'tagihan_pdam.waktu_tenggat')
            ->where('data_pdam.no_pelanggan', '=', $request->input('no_pelanggan'))
            ->get();

        return $this->showResponse($tagihanPDAM);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tagihanPDAM = DB::table('tagihan_pdam')
            ->leftJoin('data_pdam', 'tagihan_pdam.id_pdam', '=', 'data_pdam.id_pdam')
            ->select('tagihan_pdam.id', 'data_pdam.no_pelanggan', 'data_pdam.nama_pelanggan', 'tagihan_pdam.waktu_pembayaran', 'tagihan_pdam.waktu_tenggat')
            ->where('data_pdam.no_pelanggan', '=', $request->input('no_pelanggan'))
            ->first();

        if (!$tagihanPDAM) {
            return $this->notFoundResponse("Tagihan PDAM dengan no pelanggan '{$request->input('no_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pdam' => 'nullable',
            'tagihan' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        TagihanPDAM::where('id', $tagihanPDAM->id)->update($validatedData);

        $updatedTagihanPDAM = TagihanPDAM::find($tagihanPDAM->id);

        return $this->updateResponse($updatedTagihanPDAM);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanPDAM $tagihanPDAM)
    {
        $tagihanPDAM->delete();

        return response()->json(null, 204);
    }
}
