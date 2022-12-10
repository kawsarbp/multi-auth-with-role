<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nickname'=>'admin',
            'name'=>'Admin',
        ]);
        Role::create([
            'nickname'=>'user',
            'name'=>'User',
        ]);

        User::create([
           'name'=>'admin',
           'email'=>'admin@gmail.com',
           'password'=> Hash::make(123123),
           'role_id'=>1,
        ]);
        User::create([
           'name'=>'user',
           'email'=>'user@gmail.com',
           'password'=> Hash::make(123123),
           'role_id'=>2,
        ]);


    }
}
