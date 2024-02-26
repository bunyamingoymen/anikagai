<?php

namespace Database\Seeders;

use App\Models\KeyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyValueInsult extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KeyValue::Where('key', "insult")->delete();
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'abaza',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'abazan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ag',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sıçayım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ahmak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'allahsız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'am',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amarım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ambiti',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcığı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcığın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcığını',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcığınızı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcıklama',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcıklandı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amck',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amckl',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcklama',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcklaryla',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amckta',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcktan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amcuk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amına',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amınako',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminakoyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'feryadı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amını',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amısına',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminako',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminakoyarim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminakoyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminda',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amindan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amindayken',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminiyarraaniskiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aminoglu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amiyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amkafa',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amlarnzn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amlı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amq',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amsız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amteri',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amugaa',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amuğa',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amuna',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anaaann',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anal',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anana',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anandan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'amı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananınki',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);


        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananızın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananisikerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anann',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ananz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anasını',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anasının',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anayin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'angut',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anneni',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aptal',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'annesiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'anuna',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aq',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'a.q',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'a.q.',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'aq.',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ass',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'atkafası',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'atmık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'attırdığım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'avrat',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ayklarmalrmsikerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'azdım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'azdır',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'azdırıcı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kaşar',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'babanı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'babanın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezevenk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sıçayım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bacına',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bacını',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bacini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bacn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bitch',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bok',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'boka',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bokbok',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'boktan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'boku',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bokum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bombok',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'bosalmak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'boşalmak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'cenabet',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'cibiliyetsiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'çük',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dalaksız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dallama',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'daltassak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dalyarak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dalyarrak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dangalak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dassagi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dildo',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dingil',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dinsiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dkerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domal',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domalan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaldı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaldın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dmalık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domalıyor',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domalmış',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domalsın',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domalt',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaltarak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaltıp',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaltır',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'domaltırım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'dönek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'düdük',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'eben',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ebeni',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ebenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ebeninki',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ecdadını',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ecdadini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'embesil',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'emi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'fahişe',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'feriştah',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ferre',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'fuck',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'fucker',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'fucing',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'fucking',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gavad',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gavat',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'geber',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'geberik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gebermek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gebermiş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gebertir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gerızekalı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gerizekalı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gerizekali',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gerzek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gibis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gibiş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'goddamn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'godoş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'godumun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotelek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotlalesi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotlu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotten',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotundeki',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'getunden',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotune',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotunu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gotveren',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'goyiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'goyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'goyuyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'goyyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'göt',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götelek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götlalesi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götoğlanı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götoş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götten',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götü',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götün',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götüne',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götünekoyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götünü',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'götveren',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtelek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtnde',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtnden',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtne',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'gtten',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hassiktir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hassikome',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hasiktir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hassittir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'haysiyetsiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hayvanherif',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hoşaflı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hödük',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'hsktr',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'huur',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnelik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibine',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibinenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibne',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnedir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibneleri',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnelik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnerator',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ibnesi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'idiot',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'idiyot',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'imansız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ipne',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'iserim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'işerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'itoğlu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kafasız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kafasiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kahpe',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kahpenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kaka',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kaltak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kancık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kancik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kappe',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'karhane',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kaşar',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kavat',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kavatn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kaypak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kayyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kerane',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kerhane',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kerhanelerde',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kevase',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kevaşe',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kevvase',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koduğmun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koduğmunun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kodumun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kodumunun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koduumun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyarm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyayım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyiiym',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'koyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'krar',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'kukudaym',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'lavuk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'liboş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'madafaka',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mal',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'malafat',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'malak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'manyak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mcik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'meme',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'memelerini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mezveleli',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'minaamcık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mincikliyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mna',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'monakkoluyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'motherfucker',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'mudik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'oc',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ocuu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ocuun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'oç',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'o.çocuğu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'oğlancı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orosbucocuu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospucocugu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospuçocuğu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospudur',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospular',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospunun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospuydu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orospuyuz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orostoban',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orostopol',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'orrospu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'oruspu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'osbir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ossurduum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ossurmak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ossuruk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'osur',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'osurduu',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'osuruk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'osururum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'otuzbir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'öküz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'öşex',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'penis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezevek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezeven',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezeveng',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezevengi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezevengin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezevenk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pezo',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pic',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pici',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'picler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'piç',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'piçin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'piçler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pipi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pipiş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pisliktir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'porno',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'pussy',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'puşt',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'puşttur',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 's1kerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 's1kerm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 's1krm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sakso',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'saksofon',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'salaak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'salak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'saxo',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sekis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'serefsiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sevişelim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sexs',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sıçarım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sıçtığım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sıecem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sicarsin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sie',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikdi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikdiğim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sike',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikecem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siken',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siker',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikerler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikersin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikertir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikertmek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikesen',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikesicenin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikey',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikeydim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikeyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikeym',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siki',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikicem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikici',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikien',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikienler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiiimmm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiirken',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikil',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikildiini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilesice',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilmi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilmie',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilmis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilmiş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikilsin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimde',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimden',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikime',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimiin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimle',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimsonik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikimtrak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikinde',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikinden',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikine',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikip',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikisek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikisen',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikish',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikismis',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikişen',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikişme',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikitiin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiym',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikiyorum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikkim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikko',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikleri',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikleriii',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikli',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikmek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikmem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikmiler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikmisligim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikseydin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikseyidin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksinbaya',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksinler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksok',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siksz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikt',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sikti',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktigimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktigiminin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiğim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiğimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiğiminin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktii',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiiminin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiler',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiminin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktirgit',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktirir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiririm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktiriyor',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'siktirolgit',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sittimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sittir',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skcem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skecem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skem',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sker',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skerim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skerm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skeyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skime',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skmek',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sksin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sksn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sksz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sktiimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sktrr',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'skyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'slaleni',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokarım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokarim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokarm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokarmkoduumun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokayım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokaym',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'soktuğumunun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokuk',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokuş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sokuyum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'soxum',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sulaleni',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sülaleni',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sülalenizi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'sürtük',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'şerefsiz',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'şıllık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'taaklarn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'taaklarna',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'tarrakimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'tasak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'tassak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'taşak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'taşşak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 's.k',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 's.keyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'tiyniyat',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'topsun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'totoş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'vajina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'vajinanı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'veled',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'veledizina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'verdiimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'weled',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'weledizina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'whore',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'xikeyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaaraaa',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yalama',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yalarım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yalarun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaraaam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaraksız',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaraktr',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaram',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaraminbasi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yaramn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yararmorospunun',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarra',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraaaa',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraamı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarragi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarragimi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarragina',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarragindan',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarragm',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrağ',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrağım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrağımı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraimin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarram',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarramin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarraminbaşı',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarramn',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarran',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrana',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yarrrak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yavak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yavş',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yavşak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yavşaktır',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yavuşak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yılışık',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yilisik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yogurtlayam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yoğurtlayam',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'yrrak',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zıkkımım',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zibidi',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zigsin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zikeyim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zikiiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zikiim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zikik',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zikim',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ziksiiin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'ziksiin',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zulliyetini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);

        DB::table('key_values')->insert([
            [
                'code' => KeyValue::max('code') + 1,
                'key'  => 'insult',
                'value'  => 'zviyetini',
                'create_user_code' => 1,
                'deleted' => 0,
            ]
        ]);
    }
}
