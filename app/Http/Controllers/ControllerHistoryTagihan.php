<?php

namespace App\Http\Controllers;

use App\Models\HistoryTagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerHistoryTagihan extends Controller
{
    use ResponseController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historyTagihan = HistoryTagihan::all();

        return $this->showResponse($historyTagihan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = DB::table('user')
            ->where('token', $request->input('token'))
            ->value('id_user');

        $data = $request->validate([
            'id_user' => 'nullable',
            'no_pembayaran' => 'required|string',
            'nama_tagihan' => 'required|string',
            'harga' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        $data['id_user'] = $user;

        $data['no_pembayaran'] = $this->generateUniqueNoPembayaran();

        $historyTagihan = HistoryTagihan::create($data);

        return $this->storeResponse($historyTagihan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = DB::table('user')
            ->where('token', $request->input('token'))
            ->value('id_user');

        $historyTagihan = HistoryTagihan::find($user);

        if (!$historyTagihan) {
            return ResponseController::error('History Tagihan not found', 404);
        }

        return $this->showResponse($historyTagihan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistoryTagihan $historyTagihan)
    {
        $historyTagihan = HistoryTagihan::find($historyTagihan);

        if (!$historyTagihan) {
            return ResponseController::error('History Tagihan not found', 404);
        }

        $data = $request->validate([
            'no_pembayaran' => 'nullable',
            'nama_tagihan' => 'nullable',
            'harga' => 'nullable',
            'note' => 'nullable',
        ]);

        $historyTagihan = $historyTagihan->update($data);

        return $this->updateResponse($historyTagihan);
    }

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
