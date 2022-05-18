<?php

use App\UserRole;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        UserRole::create(['id' => 1, 'name' => 'admin', 'slug' => uniqid()]);
        UserRole::create(['id' => 2, 'name' => 'worker', 'slug' => uniqid()]);
        UserRole::create(['id' => 3, 'name' => 'recruiter',  'slug' => uniqid()]);
    }
}
