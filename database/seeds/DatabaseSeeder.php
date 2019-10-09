<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory("App\User", 15)->create();
        $organizations = ["Aair prt", "ERA", "Adis ababa mengedoch"]; 
        foreach($organizations as $o){
            \App\Organization::create([
                "name" => $o
            ]); 
        }

        $roles = ["clurk", "department_head", "admin"]; 
        $i = 1; 
        foreach($roles as $role){
            \App\Role::create([
                "name" => $role, 
                "id" => $i++
            ]); 
        }

        $departments = ["Minister Office", "ICT", "Human resource"];
        $users = \App\User::get(); 
        $i = 1;
        foreach($departments as $department){
            \App\Department::create([
                "name" => $department,
                "director_id" => $i++
            ]);
        }
    }
}
