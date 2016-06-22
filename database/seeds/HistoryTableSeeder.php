<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(BonusTypeTableSeeder::class);
        $this->call(BonusTableSeeder::class);
        $this->call(RabbitTypeTableSeeder::class);
        $this->call(PointTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}