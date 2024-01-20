<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryTagihanRequest;
use App\Models\DataKartu;
use App\Models\HistoryTagihan;
use App\Models\MetodePembayaran;
use App\Models\TagihanTersedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryTagihanController extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function showAll()
    {
        $historyTagihan = auth()->user()->historyTagihan()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'data' => $historyTagihan,
            'message' => 'Data History Tagihan berhasil diambil'
        ], 200);
    }

    public function store($id_tagihan_tersedia)
    {
        // $request->validated();

        $dataTagihanTersedia = TagihanTersedia::where('id', $id_tagihan_tersedia)->first();
        $dataMetodePembayaran = MetodePembayaran::where('pembayaran_utama', true)->first();
        $dataKartu = DataKartu::where('id', $dataMetodePembayaran->id)->first();

        $dataTagihanTersedia->update([
            'status' => 'Lunas',
        ]);

        $dataMetodePembayaran->update([
            'saldo' => $dataMetodePembayaran->saldo - $dataTagihanTersedia->nominal_tagihan,
        ]);

        $dataKartu->update([
            'saldo' => $dataKartu->saldo - $dataTagihanTersedia->nominal_tagihan,
        ]);

        $response = auth()->user()->historyTagihan()->create([
            'id_tagihan_tersedia' => $dataTagihanTersedia->id,
            'id_metode_pembayaran' => $dataMetodePembayaran->id,
            'no_pembayaran' => $this->generateUniqueNoPembayaran(),
            'jenis_tagihan' => $dataTagihanTersedia->jenis_tagihan,
            'no_tagihan' => $dataTagihanTersedia->no_tagihan,
            'nama_tagihan' => $dataTagihanTersedia->nama_tagihan,
            'nominal_tagihan' => $dataTagihanTersedia->nominal_tagihan,
            'waktu_bayar' => $dataTagihanTersedia->waktu_bayar,
            'status' => $dataTagihanTersedia->status,
        ]);

        return response()->json([
            'data' => $response,
            'message' => 'History Tagihan berhasil ditambahkan'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    // public function show(Request $request)
    // {
    //     $user = DB::table('user')
    //         ->where('token', $request->input('token'))
    //         ->value('id_user');

    //     $historyTagihan = HistoryTagihan::find($user);

    //     if (!$historyTagihan) {
    //         return ResponseController::error('History Tagihan not found', 404);
    //     }

    //     return $this->showResponse($historyTagihan);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, HistoryTagihan $historyTagihan)
    // {
    //     $historyTagihan = HistoryTagihan::find($historyTagihan);

    //     if (!$historyTagihan) {
    //         return ResponseController::error('History Tagihan not found', 404);
    //     }

    //     $data = $request->validate([
    //         'no_pembayaran' => 'nullable',
    //         'nama_tagihan' => 'nullable',
    //         'harga' => 'nullable',
    //         'note' => 'nullable',
    //     ]);

    //     $historyTagihan = $historyTagihan->update($data);

    //     return $this->updateResponse($historyTagihan);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryTagihan $historyTagihan)
    {
        //
    }

    private function generateUniqueNoPembayaran()
    {
        $noPembayaran = 'P' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        while (HistoryTagihan::where('no_pembayaran', $noPembayaran)->exists()) {
            $noPembayaran = 'P' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        return $noPembayaran;
    }
}
