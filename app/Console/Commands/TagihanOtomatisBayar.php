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
        $historyTagihanController = new HistoryTagihanController();
        $historyTagihanController->store();
    }
}
