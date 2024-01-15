<?php

namespace App\Http\Controllers;

use App\Models\DataPBB;
use App\Models\TagihanPBB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ControllerTagihanPBB extends Controller
{
    use ResponseController;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanBB = DB::table('tagihan_pbb')
            ->leftJoin('data_pbb', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
            ->select('tagihan_pbb.id', 'data_pbb.nop', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
            ->get();

        return $this->showResponse($tagihanBB);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataPBB = DataPBB::where('id', $request->id_pbb)->first();

        if (!$dataPBB) {
            return $this->notFoundResponse("Data PBB dengan nop '{$request->input('nop')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pbb' => 'required',
            'tagihan' => 'required',
            'waktu_bisa_bayar' => 'required',
            'waktu_tenggat' => 'required',
        ]);

        $validatedData['nop'] = $dataPBB->nop;

        $tagihanPBB = TagihanPBB::create($validatedData);

        return $this->storeResponse($tagihanPBB);
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, TagihanPBB $tagihanBB)
    {
        $tagihanBB = DB::table('tagihan_pbb')
            ->leftJoin('data_pbb', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
            ->select('tagihan_pbb.id', 'data_pbb.nop', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
            ->where('data_pbb.nop', '=', $request->input('nop'))
            ->get();
        
        if ($tagihanBB->isEmpty()) {
            return $this->notFoundResponse("Tagihan Bumi Dan Bangunan dengan nop '{$request->input('nop')}' tidak ditemukan.");
        }

        return $this->showResponse($tagihanBB);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $tagihanBB = DB::table('tagihan_pbb')
            ->leftJoin('data_pbb', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
            ->select('tagihan_pbb.id', 'data_pbb.nop', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
            ->where('data_pbb.nop', '=', $request->input('nop'))
            ->first();

        if (!$tagihanBB) {
            return $this->notFoundResponse("Data PBB dengan nop '{$request->input('nop')}' tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_pbb' => 'nullable',
            'tagihan' => 'nullable',
            'waktu_pembayaran' => 'nullable',
            'waktu_tenggat' => 'nullable',
        ]);

        TagihanPBB::where('id', $tagihanBB->id)->update($validatedData);

        $updatedTagihanBB = TagihanPBB::find($tagihanBB->id);

        return $this->updateResponse($updatedTagihanBB);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanPBB $tagihanBumiDanBangunan)
    {
        //
    }
}
