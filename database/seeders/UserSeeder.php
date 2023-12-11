<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'code' => 0,
                'name'  => 'Bünyamin',
                'surname'  => 'Göymen',
                'email' => 'bunyamingoymen@gmail.com',
                'password' => Hash::make("introlistalemi.anikagai.com"),
                'image' => 'admin/assets/images/users/avatar-1.jpg',
                'description' => "Sitenin kurucusu",
                'user_type' => 0, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'admin' => 1,
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
            [
                'id' => 2,
                'code' => 1,
                'name'  => 'Anikagai',
                'surname'  => 'Admin',
                'email' => 'anikagai@gmail.com',
                'password' => Hash::make("anikagai1256"),
                'image' => 'admin/assets/images/users/avatar-1.jpg',
                'description' => "Site Sahibi",
                'user_type' => 1, //0: Super User, 1: Admin, 2 ve daha sonrası:Yetkilendirme sistemi
                'admin' => 1,
                'create_user_code' => 0,
                'update_user_code' => 0,
                'deleted' => 0,
            ],
        ]);
    }
}
