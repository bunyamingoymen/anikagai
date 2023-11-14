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
                'code' => 0,
                'name'  => 'Bünyamin',
                'surname'  => 'Göymen',
                'email' => 'bunyamingoymen@gmail.com',
                'password' => Hash::make("123"),
                'image' => 'admin/assets/images/users/avatar-1.jpg',
                'description' => "Sitenin kurucusu",
                'user_type' => 0, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
            [
                'id' => 2,
                'code' => 1,
                'name'  => 'Bünyamin',
                'surname'  => 'Göymen',
                'email' => 'bunyamingoymen2@gmail.com',
                'password' => Hash::make("123"),
                'image' => 'admin/assets/images/users/avatar-2.jpg',
                'description' => "Site Sahibi",
                'user_type' => 0, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
        ]);
    }
}
