<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserTypeSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
