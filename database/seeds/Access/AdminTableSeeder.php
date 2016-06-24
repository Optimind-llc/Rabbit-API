<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminTableSeeder
 */
class AdminTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // if (env('DB_CONNECTION') == 'mysql') {
        //     DB::table(config('access.admins_table_name'))->truncate();
        // } elseif (env('DB_CONNECTION') == 'sqlite') {
        //     DB::statement('DELETE FROM ' . config('access.admins_table_name'));
        // } else {
        //     //For PostgreSQL or anything else
        //     DB::statement('TRUNCATE TABLE ' . config('access.admins_table_name') . ' CASCADE');
        // }

        //Add the master administrator, user id of 1
        $users = [
            [
                'family_name'       => '斉東',
                'given_name'        => '志一',
                'family_name_yomi'  => 'サイトウ',
                'given_name_yomi'   => 'シイチ',
                'email'             => 's.shiichi311041@gmail.com',
                'password'          => bcrypt('123456'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '松下',
                'given_name'        => '健',
                'family_name_yomi'  => 'マツシタ',
                'given_name_yomi'   => 'ケン',
                'email'             => 'a@a.a',
                'password'          => bcrypt('123456'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '呉',
                'given_name'        => '偉',
                'family_name_yomi'  => 'ゴ',
                'given_name_yomi'   => 'イ',
                'email'             => 'outman@live.com',
                'password'          => bcrypt('123456'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table(config('access.admins_table_name'))->insert($users);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}