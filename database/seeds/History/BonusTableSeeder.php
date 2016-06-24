<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class BonusTableSeeder
 */
class BonusTableSeeder extends Seeder
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

        $bonuses = [
            [
                'user_id'       => 1,
                'bonus_type_id' => 1,
                'code'          => '1befc8e3fb801952f31007ef41d984ea',
                'created_at'    => '2016-06-01 12:00:00',
                'updated_at'    => '2016-06-01 12:00:00',
            ],[
                'user_id'       => 1,
                'bonus_type_id' => 1,
                'code'          => '464d7379e84f51a5ab48cff9abab50ed',
                'created_at'    => '2016-06-01 13:00:00',
                'updated_at'    => '2016-06-01 13:00:00',
            ],[
                'user_id'       => 2,
                'bonus_type_id' => 2,
                'code'          => '23109ed97f2315afc9ddfe5df7e9f68c',
                'created_at'    => '2016-06-01 12:00:00',
                'updated_at'    => '2016-06-01 12:00:00',
            ],[
                'user_id'       => 3,
                'bonus_type_id' => 2,
                'code'          => '23109ed97f2315afc9ddfe5df7e9f68c',
                'created_at'    => '2016-06-01 13:00:00',
                'updated_at'    => '2016-06-01 13:00:00',
            ],
        ];

        DB::table('bonuses')->insert($bonuses);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}