<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

//use Carbon\Carbon;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        //$this->callUserSeeders();
        //$this->callKeyValueSeeder();
        //$this->callThemeSeeder();
        //$this->callOtherSeeders();
    }

    private function callUserSeeders(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AuthSeeder::class);
    }

    private function callKeyValueSeeder(): void
    {
        $this->call(KeyValueSeeder::class);
    }

    private function callThemeSeeder(): void
    {
        $this->call(ThemeSeeder::class);
    }

    private function callOtherSeeders(): void
    {
        $this->call(OtherSeeder::class);
    }
}
