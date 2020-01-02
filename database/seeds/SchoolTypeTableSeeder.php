<?php

use Illuminate\Database\Seeder;

class SchoolTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('school_type')->insert(
            [
                [
                    'type'        => 'Government'
        
                ],
                [
                    'type'        => 'Council'
        
                ],
                [
                    'type'        => 'Private'
        
                ]
            ]
           
    );
    }
}
