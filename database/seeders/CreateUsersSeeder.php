<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Admin;
use App\Models\Teacher;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=> bcrypt('admin'),
             ],
             [
                'name'=>'Teacher',
                'email'=>'teacher@gmail.com',
                'password'=> bcrypt('teacher'),
             ],
             [
                'name'=>'Student',
                'email'=>'student@gmail.com',
                'password'=> bcrypt('student'),
             ],
        ];
        
        Admin::create($users[0]);
        Teacher::create($users[1]);
        User::create($users[2]);
    }
}
