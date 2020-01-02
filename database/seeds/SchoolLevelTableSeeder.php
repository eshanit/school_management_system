<?php

use Illuminate\Database\Seeder;

class SchoolLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        DB::table('school_level')->insert(
            [
                [
                    'level'        => 'High School'
        
                ],
                [
                    'level'        => 'Secondary School'
        
                ],
                [
                    'level'        => 'Primary School'
        
                ]
            ]
           
    );
    }
}
