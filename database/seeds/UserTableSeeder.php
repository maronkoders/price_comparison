<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => 1, 
            'name' => "brian thomas", 
            'email' => 'admin@priceline.com',
            'password' => Hash::make('admin@priceline.com'),
            'user_role_id' => '1',
            'gender' =>'male',
            'dob'=>'1994-05-23',
             'slug' => uniqid()
             ]);
    }
}
