<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminTableSeeder
 */
class SchoolTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // if (env('DB_CONNECTION') == 'mysql') {
        //     DB::table('schools')->truncate();
        // } elseif (env('DB_CONNECTION') == 'sqlite') {
        //     DB::statement('DELETE FROM ' . 'schools');
        // } else {
        //     //For PostgreSQL or anything else
        //     DB::statement('TRUNCATE TABLE ' . 'schools' . ' CASCADE');
        // }

        $schools = [
            [
                'name'        => '名古屋大学',
                'yomi'        => 'ナゴヤダイガク',
                'sort'        => 1,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知教育大学',
                'yomi'        => 'アイチキョウイクダイガク',
                'sort'        => 2,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋工業大学',
                'yomi'        => 'ナゴヤコウギョウダイガク',
                'sort'        => 3,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '豊橋技術科学大学',
                'yomi'        => 'トヨハシギジュツカガクダイガク',
                'sort'        => 4,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知県立大学',
                'yomi'        => 'アイチケンリツダイガク',
                'sort'        => 5,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知県立芸術大学',
                'yomi'        => 'アイチケンリツゲイジュツダイガク',
                'sort'        => 6,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋市立大学',
                'yomi'        => 'ナゴヤシリツダイガク',
                'sort'        => 7,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知大学',
                'yomi'        => 'アイチダイガク',
                'sort'        => 8,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知医科大学',
                'yomi'        => 'アイチイカダイガク',
                'sort'        => 9,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知学院大学',
                'yomi'        => 'アイチガクインダイガク',
                'sort'        => 10,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知学泉大学',
                'yomi'        => 'アイチガクセンダイガク',
                'sort'        => 11,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知工科大学',
                'yomi'        => 'アイチコウカダイガク',
                'sort'        => 12,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知工業大学',
                'yomi'        => 'アイチコウギョウダイガク',
                'sort'        => 13,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知産業大学',
                'yomi'        => 'アイチサンギョウダイガク',
                'sort'        => 14,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知淑徳大学',
                'yomi'        => 'アイチシュクトクダイガク',
                'sort'        => 15,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知東邦大学',
                'yomi'        => 'アイチトウホウダイガク',
                'sort'        => 16,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知文教大学 ',
                'yomi'        => 'アイチブンキョウダイガク',
                'sort'        => 17,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '愛知みずほ大学',
                'yomi'        => 'アイチミズホダイガク',
                'sort'        => 18,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '桜花学園大学',
                'yomi'        => 'オウカガクエンダイガク',
                'sort'        => 19,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '岡崎女子大学',
                'yomi'        => 'オカザキジョシダイガク',
                'sort'        => 20,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '金城学院大学',
                'yomi'        => 'キンジョウガクインダイガク',
                'sort'        => 21,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '至学館大学',
                'yomi'        => 'シガッカンダイガク',
                'sort'        => 22,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '修文大学',
                'yomi'        => 'シュウブンダイガク',
                'sort'        => 23,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '椙山女学園大学',
                'yomi'        => 'スギヤマジョガクエンダイガク',
                'sort'        => 24,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '星城大学',
                'yomi'        => 'セイジョウダイガク',
                'sort'        => 25,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '大同大学',
                'yomi'        => 'タイドウダイガク',
                'sort'        => 26,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '中京大学',
                'yomi'        => 'チュウキョウダイガク',
                'sort'        => 27,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '中部大学',
                'yomi'        => 'チュウブダイガク',
                'sort'        => 28,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '東海学園大学',
                'yomi'        => 'トウカイガクインダイガク',
                'sort'        => 29,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '同朋大学',
                'yomi'        => 'ドウホウダイガク',
                'sort'        => 30,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '豊橋創造大学',
                'yomi'        => 'トヨハシソウゾウダイガク',
                'sort'        => 31,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋音楽大学',
                'yomi'        => 'ナゴヤオンガクダイガク',
                'sort'        => 32,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋外国語大学',
                'yomi'        => 'ナゴヤガイコクゴダイガク',
                'sort'        => 33,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋学院大学',
                'yomi'        => 'ナゴヤガクインダイガク',
                'sort'        => 34,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋学芸大学',
                'yomi'        => 'ナゴヤガクゲイダイガク',
                'sort'        => 35,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋経済大学',
                'yomi'        => 'ナゴヤケイザイダイガク',
                'sort'        => 36,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋芸術大学',
                'yomi'        => 'ナゴヤゲイジュツダイガク',
                'sort'        => 37,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋産業大学',
                'yomi'        => 'ナゴヤサンギョウダイガク',
                'sort'        => 38,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋商科大学',
                'yomi'        => 'ナゴヤショウカダイガク',
                'sort'        => 39,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋女子大学',
                'yomi'        => 'ナゴヤジョシダイガク',
                'sort'        => 40,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋造形大学',
                'yomi'        => 'ナゴヤゾウケイダイガク',
                'sort'        => 41,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名古屋文理大学',
                'yomi'        => 'ナゴヤブンリダイガク',
                'sort'        => 42,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '南山大学',
                'yomi'        => 'ナンザンダイガク',
                'sort'        => 43,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '日本赤十字豊田看護大学',
                'yomi'        => 'ニホンセキジュウジトヨタカンゴダイガク',
                'sort'        => 44,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '日本福祉大学',
                'yomi'        => 'ニホンフクシダイガク',
                'sort'        => 45,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '人間環境大学',
                'yomi'        => 'ニンゲンカンキョウダイガク',
                'sort'        => 46,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '藤田保健衛生大学',
                'yomi'        => 'フジタホケンエイセイダイガク',
                'sort'        => 47,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],[
                'name'        => '名城大学',
                'yomi'        => 'メイジョウダイガク',
                'sort'        => 48,
                'description' => '',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]
        ];

        DB::table('schools')->insert($schools);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}