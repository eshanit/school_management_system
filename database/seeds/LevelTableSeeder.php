<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('level')->insert(
            [
                [
                    'schoollevel_id'      => 1,
                    'level'               => 'O Level'
                ],
                [
                    'schoollevel_id'      => 1,
                    'level'               => 'A Level'
                ],
                [
                    'schoollevel_id'      => 2,
                    'level'               => 'O Level'
                ],
                [
                    'schoollevel_id'      => 3,
                    'level'               => 'ECD'
                ],
                [
                    'schoollevel_id'      => 3,
                    'level'               => 'Junior'
                ],
                [
                    'schoollevel_id'      => 3,
                    'level'               => 'Senior'
                ],
            ]
        );
    }
}
