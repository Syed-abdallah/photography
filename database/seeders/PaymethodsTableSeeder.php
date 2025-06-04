<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // If you want to start fresh each time, you can truncate first:
        // DB::table('paymethods')->truncate();

        $methods = [
            ['name' => 'Cash',        'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Credit Card','created_at' => now(), 'updated_at' => now()],
            ['name' => 'PayPal',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bank Transfer','created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mobile Payment','created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('paymethods')->insert($methods);
    }
}
