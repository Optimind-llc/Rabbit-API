<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminTableSeeder
 */
class CampusTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // if (env('DB_CONNECTION') == 'mysql') {
        //     DB::table('campuses')->truncate();
        // } elseif (env('DB_CONNECTION') == 'sqlite') {
        //     DB::statement('DELETE FROM ' . 'campuses');
        // } else {
        //     //For PostgreSQL or anything else
        //     DB::statement('TRUNCATE TABLE ' . 'campuses' . ' CASCADE');
        // }

        $campuses = [
            [
                'name'       => '東山キャンパス',
                'sort'       => 1,
                'geo_lat'    => '35.153141,35.159264,35.155352,35.148895,35.147562,35.151387',
                'geo_lon'    => '136.959750,136.962003,136.974105,136.975994,136,970050,136.966595',
                'school_id'  => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name'       => '鶴舞キャンパス',
                'sort'       => 2,
                'geo_lat'    => '35.160451,35.160091,35.155740,35.157670',
                'geo_lon'    => '136.920360,136.924105,136.923600,136.917850',
                'school_id'  => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name'       => '大幸キャンパス',
                'sort'       => 3,
                'geo_lat'    => '35.190625,35.189818,35.186.153,35.187302',
                'geo_lon'    => '136.948449,136.952247,136.951345,136.945584',
                'school_id'  => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('campuses')->insert($campuses);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}