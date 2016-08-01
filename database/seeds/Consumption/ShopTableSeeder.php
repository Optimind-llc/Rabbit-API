<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class BonusTableSeeder
 */
class ShopTableSeeder extends Seeder
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

        $shops = [
            [
                'name'           => '居酒屋ダイニング　本山ジャック',
                'name_kana'      => 'イザカヤダイニングモトヤマジャック',
                'sort'           => 1,
                'description'    => '居酒屋ダイニング　本山ジャック',
                'address'        => '愛知県名古屋市千種区不老町 名古屋大学東山キャンパス',
                'gnavi_url'      => 'http://r.gnavi.co.jp/g9d84bzz0000',
                'business_hours' => '7:30～19:00',
                'business_days'  => '7:30～19:00',
                'holiday'        => pow(2, 5) + pow(2, 5),
                'geo_lat'        => '35.160994',
                'geo_long'       => '136.964027',
                'owner_id'       => 1,
                'genre_id'       => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],[
                'name'        => 'PHONON CAFE ROOM',
                'sort'        => 1,
                'description' => 'フォノンカフェルーム',
                'geo_lat'     => '35.154784',
                'geo_long'    => '136.962851',
                'owner_id'    => ,
                'genre_id'    => ,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'restaurant',
                'sort'        => 1,
                'description' => '',
                'geo_lat'     => '35.159240',
                'geo_long'    => '136.964782',
                'owner_id'    => ,
                'genre_id'    => ,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'restaurant',
                'sort'        => 1,
                'description' => '',
                'geo_lat'     => '',
                'geo_long'    => '',
                'owner_id'    => ,
                'genre_id'    => ,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],[
                'name'        => 'restaurant',
                'sort'        => 1,
                'description' => '',
                'geo_lat'     => '',
                'geo_long'    => '',
                'owner_id'    => ,
                'genre_id'    => ,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]
        ];

        DB::table('shops')->insert($shops);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}