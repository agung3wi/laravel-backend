<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ApproveSaleFinish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Aprove Otomatis ketika diterima tapi lebih dari 3 hari
        $saleList = DB::table("sales")->where([
            "status" => "D"
        ])->whereRaw('receive_date < DATE_ADD(CURDATE(), INTERVAL -3 DAY)')->get();

        foreach ($saleList as $sale) {
            // Email Notification
            DB::table("sales")->where("id", $sale->id)
                ->update([
                    "status" => "F",
                    "updated_at" => date("Y-m-d H:i:s")
                ]);
        }
    }
}
