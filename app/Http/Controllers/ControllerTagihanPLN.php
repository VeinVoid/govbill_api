<?php

namespace App\Http\Controllers;

use App\Models\TagihanListrikPLN;
use App\Models\TagihanPLN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTagihanPLN extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanPLN = DB::table('tagihan_pln')
            ->leftJoin('data_pln', 'tagihan_pln.id_pln', '=', 'data_pln.id_pln')
            ->select('tagihan_pln.id', 'data_pln.id_pelanggan', 'data_pln.nama_pelanggan', 'tagihan_pln.waktu_pembayaran', 'tagihan_pln.waktu_tenggat')
            ->get();

        return $this->showResponse($tagihanPLN);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pln = DB::table('data_pln')
            ->where('id_pelanggan', $request->input('id_pelanggan'))
            ->value('id_pln');

        if (!$id_pln) {
            return $this->notFoundResponse("Data PLN dengan id pelanggan '{$request->input('id_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pln' => 'required',
            'tagihan' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['id_pln'] = $id_pln;

        $tagihanListrikPLN = TagihanPLN::create($validatedData);

        return response()->json($tagihanListrikPLN, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tagihanPLN = DB::table('tagihan_pln')
            ->leftJoin('data_pln', 'tagihan_pln.id_pln', '=', 'data_pln.id_pln')
            ->select('tagihan_pln.id', 'data_pln.id_pelanggan', 'data_pln.nama_pelanggan', 'tagihan_pln.waktu_pembayaran', 'tagihan_pln.waktu_tenggat')
            ->where('data_pln.id_pelanggan', '=', $request->input('id_pelanggan'))
            ->get();

        return $this->showResponse($tagihanPLN);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tagihanPLN = DB::table('tagihan_pln')
            ->leftJoin('data_pln', 'tagihan_pln.id_pln', '=', 'data_pln.id_pln')
            ->select('tagihan_pln.id', 'data_pln.id_pelanggan', 'data_pln.nama_pelanggan', 'tagihan_pln.waktu_pembayaran', 'tagihan_pln.waktu_tenggat')
            ->where('data_pln.id_pelanggan', '=', $request->input('id_pelanggan'))
            ->first();

        if (!$tagihanPLN) {
            return $this->notFoundResponse("Tagihan PLN dengan id pelanggan '{$request->input('id_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pln' => 'nullable',
            'tagihan' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        TagihanPLN::where('id', $tagihanPLN->id)->update($validatedData);

        $updatedTagihanPLN = TagihanPLN::find($tagihanPLN->id);

        return $this->updateResponse($updatedTagihanPLN);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanPLN $tagihanListrikPLN)
    {
        $tagihanListrikPLN->delete();

        return response()->json(null, 204);
    }
}
