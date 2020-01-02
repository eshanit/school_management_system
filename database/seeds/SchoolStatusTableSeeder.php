<?php

use Illuminate\Database\Seeder;

class SchoolStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('school_status')->insert(
            [
                [
                    'status'        => 'Boarding'
        
                ],
                [
                    'status'        => 'Day'
        
                ]
            ]
           
    );
    }
}
