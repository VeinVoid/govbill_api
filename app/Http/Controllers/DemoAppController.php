<?php

namespace App\Http\Controllers;

use App\Models\DataTagihan;
use App\Models\HistoryTagihan;
use App\Models\TagihanTersedia;
use Illuminate\Http\Request;

class DemoAppController extends Controller
{
    public function reset()
    {
        $tagihanTersedias = TagihanTersedia::all();
        $dataTagihans = DataTagihan::all();
        $histories = HistoryTagihan::all();

        foreach ($tagihanTersedias as $tagihanTersedia) {
            $tagihanTersedia->update([
                'status' => 'Belum Lunas',
            ]);
        }

        foreach ($histories as $history) {
            $history->delete();
        }

        foreach ($dataTagihans as $dataTagihan) {
            $dataTagihan->update([
                'status' => 'Belum Lunas',
            ]);
        }

        return response()->json([
            'message' => 'Data berhasil direset'
        ], 200);
    }
}
