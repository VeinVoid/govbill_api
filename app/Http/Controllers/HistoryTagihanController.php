<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryTagihanRequest;
use App\Models\DataKartu;
use App\Models\DataTagihan;
use App\Models\HistoryTagihan;
use App\Models\MetodePembayaran;
use App\Models\TagihanTersedia;
use Carbon\Carbon;
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

        foreach ($historyTagihan as $tagihan) {
            $tagihan->nominal_tagihan = (int) $tagihan->nominal_tagihan;
            $tagihan->id_user = (int) $tagihan->id_user;
            $tagihan->id_tagihan_tersedia = (int) $tagihan->id_tagihan_tersedia;
            $tagihan->id_metode_pembayaran = (int) $tagihan->id_metode_pembayaran;
        }

        return response()->json([
            'data' => $historyTagihan,
            'message' => 'Data History Tagihan berhasil diambil'
        ], 200);
    }

    public function store()
    {
        $dateNow = Carbon::now()->format('Y-m-d');
        $tagihanTersedias = TagihanTersedia::where('waktu_bayar', $dateNow)->where('status', 'Belum Lunas')->get();
        
        $responses = [];

        foreach ($tagihanTersedias as $tagihanTersedia) {
            $dataTagihan = DataTagihan::where('no_tagihan', $tagihanTersedia->no_tagihan)->first();
            $metodePembayaran = MetodePembayaran::where('id_user', $tagihanTersedia->id_user)->where('pembayaran_utama', true)->first();
            $dataKartu = DataKartu::where('id', $metodePembayaran->id)->first();
    
            $tagihanTersedia->update([
                'status' => 'Lunas',
            ]);

            $dataTagihan->update([
                'status' => 'Lunas',
            ]);
    
            $metodePembayaran->update([
                'saldo' => $metodePembayaran->saldo - $tagihanTersedia->nominal_tagihan,
            ]);
    
            $dataKartu->update([
                'saldo' => $dataKartu->saldo - $tagihanTersedia->nominal_tagihan,
            ]);

            $response = HistoryTagihan::create([
                'id_user' => $tagihanTersedia->id_user,
                'id_tagihan_tersedia' => $tagihanTersedia->id,
                'id_metode_pembayaran' => $metodePembayaran->id,
                'no_pembayaran' => $this->generateUniqueNoPembayaran(),
                'jenis_tagihan' => $tagihanTersedia->jenis_tagihan,
                'no_tagihan' => $tagihanTersedia->no_tagihan,
                'nama_tagihan' => $tagihanTersedia->nama_tagihan,
                'nominal_tagihan' => $tagihanTersedia->nominal_tagihan,
                'waktu_bayar' => $tagihanTersedia->waktu_bayar,
                'status' => $tagihanTersedia->status,
            ]);

            $responses[] = $response;
        }

        if (!empty($responses)) {
            return response()->json([
                'data' => $responses,
                'message' => 'History tagihan berhasil ditambahkan'
            ], 201);
        }

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
