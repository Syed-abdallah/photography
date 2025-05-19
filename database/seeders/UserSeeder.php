<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => Carbon::parse('2025-05-19 20:22:35'),
            'password' => Hash::make('123123123'),
            'remember_token' => null,
            'created_at' => Carbon::parse('2025-05-19 20:29:52'),
            'updated_at' => Carbon::parse('2025-05-19 00:00:00'),
        ]);
        
        // You can add more users here if needed
    }
}