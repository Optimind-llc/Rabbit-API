<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.users_table_name'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.users_table_name'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.users_table_name') . ' CASCADE');
        }

        //Add the master administrator, user id of 1
        $users = [
            [
                'family_name'       => 'Jobs',
                'given_name'        => 'Steve',
                'family_name_yomi'  => 'ジョブズ',
                'given_name_yomi'   => 'スティーブ',
                'phone'             => '09044444444',
                'sex'               => 1,
                'birthday'          => '1991/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'test@rabbit.com',
                'password'          => bcrypt('iloveapple'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => '23109ed97f2315afc9ddfe5df7e9f68c',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '鈴木',
                'given_name'        => '花子',
                'family_name_yomi'  => 'スズキ',
                'given_name_yomi'   => 'ハナコ',
                'phone'             => '09022222222',
                'sex'               => 0,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'suzuki@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => '1befc8e3fb801952f31007ef41d984ea',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '前川',
                'given_name'        => '知世',
                'family_name_yomi'  => 'マエカワ',
                'given_name_yomi'   => 'トモヨ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'maekawa@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => '464d7379e84f51a5ab48cff9abab50ed',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '西島',
                'given_name'        => '利恵',
                'family_name_yomi'  => 'ニシジマ',
                'given_name_yomi'   => 'リエ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'nisizima@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '江田',
                'given_name'        => 'まみ',
                'family_name_yomi'  => 'エダ',
                'given_name_yomi'   => 'マミ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'eda@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '如月',
                'given_name'        => '恵里子',
                'family_name_yomi'  => 'キサラギ',
                'given_name_yomi'   => 'エリコ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'kisaragi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '古畑',
                'given_name'        => '綾花',
                'family_name_yomi'  => 'フルハタ',
                'given_name_yomi'   => 'アヤカ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'furuhata@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '芹沢',
                'given_name'        => '聖子',
                'family_name_yomi'  => 'セリザワ',
                'given_name_yomi'   => 'ショウコ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'serizawa@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '菅澤',
                'given_name'        => '理加',
                'family_name_yomi'  => 'スガサワ',
                'given_name_yomi'   => 'リカ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'sugasawa@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '平藤',
                'given_name'        => '麗実',
                'family_name_yomi'  => 'ヒラトウ',
                'given_name_yomi'   => 'レミ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'hirato@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '紙谷',
                'given_name'        => '夏樹',
                'family_name_yomi'  => 'カミヤ',
                'given_name_yomi'   => 'ナツキ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'kamiya@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '安宅',
                'given_name'        => '友里子',
                'family_name_yomi'  => 'アタカ',
                'given_name_yomi'   => 'ユリコ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'ataka@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '徐',
                'given_name'        => '江梨',
                'family_name_yomi'  => 'ソ',
                'given_name_yomi'   => 'エリ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'so@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '中路',
                'given_name'        => '絹代',
                'family_name_yomi'  => 'ナカジ',
                'given_name_yomi'   => 'キヌヨ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'nakazi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '川角',
                'given_name'        => '実央',
                'family_name_yomi'  => 'カワスミ',
                'given_name_yomi'   => 'ミオ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'kawasumi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '関塚',
                'given_name'        => '美砂子',
                'family_name_yomi'  => 'セキヅカ',
                'given_name_yomi'   => 'ミサコ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'sekiduka@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '川橋',
                'given_name'        => '温美',
                'family_name_yomi'  => 'カワハシ',
                'given_name_yomi'   => 'アツミ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'kawahasi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '千足',
                'given_name'        => '由有',
                'family_name_yomi'  => 'チアシ',
                'given_name_yomi'   => 'ユウ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'tiasi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '尾井',
                'given_name'        => '咲耶',
                'family_name_yomi'  => 'オイ',
                'given_name_yomi'   => 'サヤ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'oi@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '須納瀬',
                'given_name'        => '恭江',
                'family_name_yomi'  => 'スノセ',
                'given_name_yomi'   => 'ヤスエ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'sunose@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],[
                'family_name'       => '福迫',
                'given_name'        => '由梨乃',
                'family_name_yomi'  => 'フクサコ',
                'given_name_yomi'   => 'ユリコ',
                'phone'             => '09022222222',
                'sex'               => 1,
                'birthday'          => '1992/01/01',
                'postal_code'       => 3334444,
                'state'             => '愛知県',
                'city'              => '名古屋市千種区',
                'street'            => '不老町',
                'building'          => '',
                'email'             => 'fukusako@rabbit.com',
                'password'          => bcrypt('123456'),
                'device_id'         => null,
                'device_os'         => null,
                'token'             => md5(uniqid(mt_rand(), true)),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'school_id'         => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ];

        DB::table(config('access.users_table_name'))->insert($users);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}