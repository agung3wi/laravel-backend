<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // R => Baru Checkout
        // S => Sudah Dikirim
        // D => Diterima
        // F => Selesai
        DB::table("sales")->delete();
        DB::table("sales")->insert([
            [
                "doc_no" => "SL-001",
                "order_date" => "2022-01-01",
                "send_date" => "2022-01-03",
                "receive_date" => "2022-01-04",
                "status" => "F",
                "remark" => "",
                "created_at" => "2022-01-01 00:00:00",
                "updated_at" => "2022-01-04 00:00:00"
            ],
            [
                "doc_no" => "SL-002",
                "order_date" => "2022-03-01",
                "send_date" => "2022-03-03",
                "receive_date" => null,
                "status" => "S",
                "remark" => "",
                "created_at" => "2022-01-01 00:00:00",
                "updated_at" => "2022-03-03 00:00:00"
            ],
            [
                "doc_no" => "SL-003",
                "order_date" => "2022-03-03",
                "send_date" => null,
                "receive_date" => null,
                "status" => "R",
                "remark" => "",
                "created_at" => "2022-01-01 00:00:00",
                "updated_at" => "2022-03-03 00:00:00"
            ],
            [
                "doc_no" => "SL-004",
                "order_date" => "2022-03-03",
                "send_date" => "2022-03-06",
                "receive_date" => "2022-03-08",
                "status" => "D",
                "remark" => "",
                "created_at" => "2022-01-01 00:00:00",
                "updated_at" => "2022-03-03 00:00:00"
            ],
            [
                "doc_no" => "SL-004",
                "order_date" => "2022-03-03",
                "send_date" => "2022-03-04",
                "receive_date" => "2022-03-06",
                "status" => "D",
                "remark" => "",
                "created_at" => "2022-01-01 00:00:00",
                "updated_at" => "2022-03-03 00:00:00"
            ]

        ]);
    }
}
