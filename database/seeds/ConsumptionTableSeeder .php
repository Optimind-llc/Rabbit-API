<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumptionTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(GenreTypeTableSeeder::class);
        // $this->call(ShopTableSeeder::class);
        // $this->call(ItemTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}