<?php

namespace App\Http\Controllers;

use App\Models\TagihanUser;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ControllerTagihanUser extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanAll = [];

        $tagihanUser = TagihanUser::all();

        foreach ($tagihanUser as $tagihan) {
            if ($tagihan->tipe_tagihan == 'BP') {
                $tagihanBPJS = DB::table('tagihan_bpjs')
                    ->leftJoin('data_bpjs', 'tagihan_bpjs.id_bpjs', '=', 'data_bpjs.id_bpjs')
                    ->select('data_bpjs.no_va as nomor_tagihan', 'data_bpjs.nama_peserta', 'tagihan_bpjs.waktu_pembayaran', 'tagihan_bpjs.waktu_tenggat')
                    ->whereDate('tagihan_bpjs.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();
        
                $tagihanAll[] = $tagihanBPJS->toArray();
            } elseif ($tagihan->tipe_tagihan == 'PB') {
                $tagihanBB = DB::table('tagihan_pbb')
                    ->leftJoin('data_pbb', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
                    ->select('data_pbb.nop as nomor_tagihan', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
                    ->whereDate('tagihan_pbb.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();
        
                $tagihanAll[] = $tagihanBB->toArray();
            } elseif ($tagihan->tipe_tagihan == 'PG') {
                $tagihanGas = DB::table('tagihan_pgn')
                    ->leftJoin('data_pgn', 'tagihan_pgn.id_pgn', '=', 'data_pgn.id_pgn')
                    ->select('data_pgn.no_pelanggan as nomor_tagihan', 'data_pgn.nama_pelanggan', 'tagihan_pgn.waktu_pembayaran', 'tagihan_pgn.waktu_tenggat')
                    ->whereDate('tagihan_pgn.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanGas->toArray();

            } elseif ($tagihan->tipe_tagihan == 'PD') {
                $tagihanPDAM = DB::table('tagihan_pdam')
                    ->leftJoin('data_pdam', 'tagihan_pdam.id_pdam', '=', 'data_pdam.id_pdam')
                    ->select('data_pdam.no_pelanggan as nomor_tagihan', 'data_pdam.nama_pelanggan', 'tagihan_pdam.waktu_pembayaran', 'tagihan_pdam.waktu_tenggat')
                    ->whereDate('tagihan_pdam.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanPDAM->toArray();

            } elseif ($tagihan->tipe_tagihan == 'PL') {
                $tagihanPLN = DB::table('tagihan_pln')
                    ->leftJoin('data_pln', 'tagihan_pln.id_pln', '=', 'data_pln.id_pln')
                    ->select('data_pln.id_pelanggan as nomor_tagihan', 'data_pln.nama_pelanggan', 'tagihan_pln.waktu_pembayaran', 'tagihan_pln.waktu_tenggat')
                    ->whereDate('tagihan_pln.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanPLN->toArray();
            }
        }
        
        $mergedTagihanAll = array_merge(...$tagihanAll);

        $uniqueTagihanAll = array_map("unserialize", array_unique(array_map("serialize", $mergedTagihanAll)));

        return $this->showResponse($uniqueTagihanAll);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_user = DB::table('user')
            ->where('token', $request->input('token'))
            ->value('id_user');

        if (!$id_user) {
            return $this->notFoundResponse("User tidak ditemukan.");
        }

        $validatedData = $request->validate([
            'id_user' => 'nullable',
            'nomor_tagihan' => 'required',
            'tipe_tagihan' => 'required',
        ]);

        $validatedData['id_user'] = $id_user;

        $tagihanUser = TagihanUser::create($validatedData);

        return $this->storeResponse($tagihanUser);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tagihanAll = [];

        $user_token = $request->input('user_token');

        $tagihanUser = DB::table('tagihan_user')
            ->leftJoin('user', 'user.token', '=', 'user.token')
            ->select('tagihan_user.*')
            ->where('user.token', $user_token)
            ->get();

        foreach ($tagihanUser as $tagihan) {
            if ($tagihan->tipe_tagihan == 'BP') {
                $tagihanBPJS = DB::table('tagihan_bpjs')
                    ->leftJoin('data_bpjs', 'tagihan_bpjs.id_bpjs', '=', 'data_bpjs.id_bpjs')
                    ->select('data_bpjs.no_va as nomor_tagihan', 'data_bpjs.nama_peserta', 'tagihan_bpjs.waktu_pembayaran', 'tagihan_bpjs.waktu_tenggat')
                    ->whereDate('tagihan_bpjs.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();
        
                $tagihanAll[] = $tagihanBPJS->toArray();
            } elseif ($tagihan->tipe_tagihan == 'PB') {
                $tagihanBB = DB::table('tagihan_pbb')
                    ->leftJoin('data_pbb', 'tagihan_pbb.id_pbb', '=', 'data_pbb.id_pbb')
                    ->select('data_pbb.nop as nomor_tagihan', 'tagihan_pbb.waktu_pembayaran', 'tagihan_pbb.waktu_tenggat', 'data_pbb.nama_pemilik', 'data_pbb.provinsi', 'data_pbb.kota')
                    ->whereDate('tagihan_pbb.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();
        
                $tagihanAll[] = $tagihanBB->toArray();
            } elseif ($tagihan->tipe_tagihan == 'PG') {
                $tagihanGas = DB::table('tagihan_pgn')
                    ->leftJoin('data_pgn', 'tagihan_pgn.id_pgn', '=', 'data_pgn.id_pgn')
                    ->select('data_pgn.no_pelanggan as nomor_tagihan', 'data_pgn.nama_pelanggan', 'tagihan_pgn.waktu_pembayaran', 'tagihan_pgn.waktu_tenggat')
                    ->whereDate('tagihan_pgn.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanGas->toArray();

            } elseif ($tagihan->tipe_tagihan == 'PD') {
                $tagihanPDAM = DB::table('tagihan_pdam')
                    ->leftJoin('data_pdam', 'tagihan_pdam.id_pdam', '=', 'data_pdam.id_pdam')
                    ->select('data_pdam.no_pelanggan as nomor_tagihan', 'data_pdam.nama_pelanggan', 'tagihan_pdam.waktu_pembayaran', 'tagihan_pdam.waktu_tenggat')
                    ->whereDate('tagihan_pdam.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanPDAM->toArray();

            } elseif ($tagihan->tipe_tagihan == 'PL') {
                $tagihanPLN = DB::table('tagihan_pln')
                    ->leftJoin('data_pln', 'tagihan_pln.id_pln', '=', 'data_pln.id_pln')
                    ->select('data_pln.id_pelanggan as nomor_tagihan', 'data_pln.nama_pelanggan', 'tagihan_pln.waktu_pembayaran', 'tagihan_pln.waktu_tenggat')
                    ->whereDate('tagihan_pln.waktu_pembayaran', '<=', now()->format('Y-m-d'))
                    ->get();

                $tagihanAll[] = $tagihanPLN->toArray();
            }
        }
        
        $mergedTagihanAll = array_merge(...$tagihanAll);

        $uniqueTagihanAll = array_map("unserialize", array_unique(array_map("serialize", $mergedTagihanAll)));

        return $this->showResponse($uniqueTagihanAll);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user_token = $request->input('user_token');

        $tagihanUser = DB::table('tagihan_user')
            ->leftJoin('user', 'user.token', '=', 'user.token')
            ->select('tagihan_user.*')
            ->where('user.token', $user_token)
            ->get();

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanUser $tagihanUser)
    {
        //
    }
}
