<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'name'      => 'dsi',
                'email'     =>  'dsi@murambindaschools.co.zw',
                'password'     => Hash::make(12345678),
                'school_id' => 0
            ]
    );
    }
}
