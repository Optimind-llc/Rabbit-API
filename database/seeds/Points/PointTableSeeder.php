<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminTableSeeder
 */
class PointTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table('points')->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . 'points');
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . 'points' . ' CASCADE');
        }

        $points = [
            [
                'user_id'      => 1,
                'point'        => 15,
                'history_type' => 'bonus',
                'history_id'   => 1,
                'created_at'   => '2016-06-01 12:00:00',
                'updated_at'   => '2016-06-01 12:00:00',
            ],[
                'user_id'      => 1,
                'point'        => 15,
                'history_type' => 'bonus',
                'history_id'   => 2,
                'created_at'   => '2016-06-01 13:00:00',
                'updated_at'   => '2016-06-01 13:00:00',
            ],[
                'user_id'      => 2,
                'point'        => 15,
                'history_type' => 'bonus',
                'history_id'   => 3,
                'created_at'   => '2016-06-01 12:00:00',
                'updated_at'   => '2016-06-01 12:00:00',
            ],[
                'user_id'      => 3,
                'point'        => 15,
                'history_type' => 'bonus',
                'history_id'   => 4,
                'created_at'   => '2016-06-01 13:00:00',
                'updated_at'   => '2016-06-01 13:00:00',
            ],
        ];

        DB::table('points')->insert($points);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}