<?php

namespace App\Http\Controllers;

use App\Models\TagihanBPJS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ControllerTagihanBPJS extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanBPJS = DB::table('tagihan_bpjs')
            ->leftJoin('data_bpjs', 'tagihan_bpjs.id_bpjs', '=', 'data_bpjs.id_bpjs')
            ->select('tagihan_bpjs.id', 'data_bpjs.no_va', 'data_bpjs.nama_peserta', 'tagihan_bpjs.waktu_pembayaran', 'tagihan_bpjs.waktu_tenggat')
            ->get();

        return $this->showResponse($tagihanBPJS);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_bpjs = DB::table('data_bpjs')
            ->where('no_va', $request->input('no_va'))
            ->value('id_bpjs');

        if (!$id_bpjs) {
            return $this->notFoundResponse("Data BPJS dengan no va '{$request->input('no_va')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_bpjs' => 'nullable',
            'tagihan' => 'required',
            'waktu_pembayaran' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['id_bpjs'] = $id_bpjs;

        $tagihanBPJS = TagihanBPJS::create($validatedData);

        return $this->storeResponse($tagihanBPJS);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tagihanBPJS = DB::table('tagihan_bpjs')
            ->leftJoin('data_bpjs', 'tagihan_bpjs.id_bpjs', '=', 'data_bpjs.id_bpjs')
            ->select('tagihan_bpjs.id', 'data_bpjs.no_va', 'data_bpjs.nama_peserta', 'tagihan_bpjs.waktu_pembayaran', 'tagihan_bpjs.waktu_tenggat')
            ->where('data_bpjs.no_va', '=', $request->input('noVa'))
            ->get();

        if ($tagihanBPJS->isEmpty()) {
            return $this->notFoundResponse("Tagihan BPJS dengan noVa '{$request->input('noVa')}' tidak ditemukan.");
        }

        return $this->showResponse($tagihanBPJS);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tagihanBPJS = DB::table('tagihan_bpjs')
            ->leftJoin('data_bpjs', 'tagihan_bpjs.id_bpjs', '=', 'data_bpjs.id_bpjs')
            ->select('tagihan_bpjs.id', 'data_bpjs.no_va', 'data_bpjs.nama_peserta', 'tagihan_bpjs.waktu_pembayaran', 'tagihan_bpjs.waktu_tenggat')
            ->where('data_bpjs.no_va', '=', $request->input('noVa'))
            ->first();

        if (!$tagihanBPJS) {
            return $this->notFoundResponse("Data BPJS dengan no_va '{$request->input('noVa')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'no_va' => 'nullable',
            'tagihan' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        TagihanBPJS::where('id', $tagihanBPJS->id)->update($validatedData);

        $updatedTagihanBPJS = TagihanBPJS::find($tagihanBPJS->id);

        return $this->updateResponse($updatedTagihanBPJS);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanBPJS $tagihanBPJS)
    {
        $tagihanBPJS->delete();

        return $this->deleteResponse();
    }
}
