<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class BonusTableSeeder
 */
class ItemTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // if (env('DB_CONNECTION') == 'mysql') {
        //     DB::table('bonuses')->truncate();
        // } elseif (env('DB_CONNECTION') == 'sqlite') {
        //     DB::statement('DELETE FROM ' . 'bonuses');
        // } else {
        //     //For PostgreSQL or anything else
        //     DB::statement('TRUNCATE TABLE ' . 'bonuses' . ' CASCADE');
        // }

        $now = Carbon::now();

        $genres = [
            [
                'name'        => 'restaurant',
                'sort'        => 1,
                'description' => 'Food & Drink',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'store',
                'sort'        => 2,
                'description' => 'Store',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'beauty',
                'sort'        => 3,
                'description' => 'Fashion & Beauty',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'other',
                'sort'        => 4,
                'description' => 'Other',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('genres')->insert($genres);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}