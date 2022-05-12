<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin@admin.com',
            'email'=>'admin@admin.com',
            'password'=>'$2y$10$7UUAHkq3OhYDK1lCPxYWU.CaU2yevUGc81NY7GBvQtdlDv9Cs/RVu',
        ]);

    }
}
