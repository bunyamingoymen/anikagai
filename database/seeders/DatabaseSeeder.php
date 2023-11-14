<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'code' => 1,
                'name'  => 'Bünyamin Göymen',
                'email' => 'bunyamingoymen@gmail.com',
                'password' => Hash::make("Gazi27abc."),
                'optional' => "Sitenin kurucusu",
                'visible' => 0,
                'user_type' => 0, //0: Super User, 1: Admin, 2: Normal Kullanıcı
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
        ]);
    }
}
