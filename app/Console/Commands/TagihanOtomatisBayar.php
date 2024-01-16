<?php

namespace App\Console\Commands;

use App\Http\Controllers\HistoryTagihanController;
use App\Http\Requests\HistoryTagihanRequest;
use App\Models\TagihanTersedia;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TagihanOtomatisBayar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tagihan:otomatis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateNow = Carbon::now()->format('Y-m-d');

        $tagihanTersedia = TagihanTersedia::where('waktu_bayar', $dateNow)->where('status', 'Belum Lunas')->get();

        foreach ($tagihanTersedia as $tagihan) {
            $historyTagihanController = new HistoryTagihanController();
            $historyTagihanController->store($tagihan->id);
        }
    }
}
