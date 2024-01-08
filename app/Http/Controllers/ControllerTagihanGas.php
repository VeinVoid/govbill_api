<?php

namespace App\Http\Controllers;

use App\Models\TagihanGas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTagihanGas extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanGas = DB::table('tagihan_pgn')
            ->leftJoin('data_pgn', 'tagihan_pgn.id_pgn', '=', 'data_pgn.id_pgn')
            ->select('tagihan_pgn.id', 'data_pgn.no_pelanggan', 'data_pgn.nama_pelanggan', 'tagihan_pgn.waktu_pembayaran', 'tagihan_pgn.waktu_tenggat')
            ->get();

        return $this->showResponse($tagihanGas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pgn = DB::table('data_pgn')
            ->where('no_pelanggan', $request->input('no_pelanggan'))
            ->value('id_pgn');

        if (!$id_pgn) {
            return $this->notFoundResponse("Data PGN dengan no pelanggan '{$request->input('no_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pgn' => 'nullable',
            'tagihan' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['id_pgn'] = $id_pgn;

        $tagihanGas = TagihanGas::create($validatedData);

        return $this->storeResponse($tagihanGas);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tagihanGas = DB::table('tagihan_pgn')
            ->leftJoin('data_pgn', 'tagihan_pgn.id_pgn', '=', 'data_pgn.id_pgn')
            ->select('tagihan_pgn.id', 'data_pgn.no_pelanggan', 'data_pgn.nama_pelanggan', 'tagihan_pgn.waktu_pembayaran', 'tagihan_pgn.waktu_tenggat')
            ->where('data_pgn.no_pelanggan', '=', $request->input('no_pelanggan'))
            ->get();

        return $this->showResponse($tagihanGas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tagihanGas = DB::table('tagihan_pgn')
            ->leftJoin('data_pgn', 'tagihan_pgn.id_pgn', '=', 'data_pgn.id_pgn')
            ->select('tagihan_pgn.id', 'data_pgn.no_pelanggan', 'data_pgn.nama_pelanggan', 'tagihan_pgn.waktu_pembayaran', 'tagihan_pgn.waktu_tenggat')
            ->where('data_pgn.no_pelanggan', '=', $request->input('no_pelanggan'))
            ->first();

        if (!$tagihanGas) {
            return $this->notFoundResponse("Tagihan PGN dengan no pelanggan '{$request->input('no_pelanggan')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pgn' => 'nullable',
            'tagihan' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        TagihanGas::where('id', $tagihanGas->id)->update($validatedData);

        $updatedTagihanGas = TagihanGas::find($tagihanGas->id);

        return $this->updateResponse($updatedTagihanGas);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanGas $tagihanGas)
    {
        $tagihanGas->delete();

        return response()->json(null, 204);
    }
}
