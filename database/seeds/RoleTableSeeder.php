<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
        DB::table('roles')->insert(
            [
                [
                    'rolename'      => 'Admin'
                ],
                [
                    'rolename'      => 'Clerk'
                
                ],
                [
                    'rolename'      => 'Head'
                
                ],
                [
                    'rolename'      => 'Teacher'
                
                ],
                [
                    'rolename'      => 'Deputy Head'
                
                ],
                [
                    'rolename'      => 'dis'
                
                ]
            ]
           
    );
    }
}
