<?php

use Illuminate\Database\Seeder;

class SchoolTermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('terms')->insert(
            [
                [
                    'term'        => 'Term 1'
        
                ],
                [
                    'term'        => 'Term 2'
        
                ],
                [
                    'term'        => 'Term 3'
        
                ]
            ]
           
    );
    }
}
