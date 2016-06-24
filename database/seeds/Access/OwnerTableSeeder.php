<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class OwnerTableSeeder
 */
class OwnerTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // if (env('DB_CONNECTION') == 'mysql') {
        //     DB::table(config('access.owners_table_name'))->truncate();
        // } elseif (env('DB_CONNECTION') == 'sqlite') {
        //     DB::statement('DELETE FROM ' . config('access.owners_table_name'));
        // } else {
        //     //For PostgreSQL or anything else
        //     DB::statement('TRUNCATE TABLE ' . config('access.owners_table_name') . ' CASCADE');
        // }

        //Add the master administrator, user id of 1
        $users = [
            [
                'family_name'       => '山田',
                'given_name'        => '稔',
                'family_name_yomi'  => 'ヤマダ',
                'given_name_yomi'   => 'ミノル',
                'email'             => 'y.minoru@rabbit.com',
                'password'          => bcrypt('123456'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '鈴木',
                'given_name'        => '信行',
                'family_name_yomi'  => 'スズキ',
                'given_name_yomi'   => 'ノブユキ',
                'email'             => 's.nobuyuki@rabbit.com',
                'password'          => bcrypt('123456'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '伊藤',
                'given_name'        => '敏弘',
                'family_name_yomi'  => 'イトウ',
                'given_name_yomi'   => 'トシヒロ',
                'email'             => 'i.toshihiro@rabbit.com',
                'password'          => bcrypt('123456'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '佐藤',
                'given_name'        => '壮太',
                'family_name_yomi'  => 'サトウ',
                'given_name_yomi'   => 'ソウタ',
                'email'             => 's.souta@rabbit.com',
                'password'          => bcrypt('123456'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '山本',
                'given_name'        => '清人',
                'family_name_yomi'  => 'ヤマモト',
                'given_name_yomi'   => 'キヨト',
                'email'             => 'y.kiyoto@rabbit.com',
                'password'          => bcrypt('123456'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('access.owners_table_name'))->insert($users);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}