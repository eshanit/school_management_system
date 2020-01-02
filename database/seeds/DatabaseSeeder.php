<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            GenderTableSeeder::class,
            LevelTableSeeder::class,
            RoleTableSeeder::class,
            RoleUserTableSeeder::class,
            SchoolLevelTableSeeder::class,
            SchoolStatusTableSeeder::class,
            SchoolTermTableSeeder::class,
            SchoolTypeTableSeeder::class
        ]);
    }

}

