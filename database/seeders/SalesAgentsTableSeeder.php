<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesAgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: clear out existing rows
        // DB::table('sales_agents')->truncate();

        $agents = [
            [
                'name'           => 'Alice Johnson',
                'contact_number' => '555-123-4567',
                'email'          => 'alice.johnson@example.com',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Bob Martínez',
                'contact_number' => '555-987-6543',
                'email'          => 'bob.martinez@example.com',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Carla Singh',
                'contact_number' => '555-246-8102',
                'email'          => 'carla.singh@example.com',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'David O’Connor',
                'contact_number' => '555-369-2581',
                'email'          => 'david.oconnor@example.com',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Elena Petrova',
                'contact_number' => '555-111-2222',
                'email'          => 'elena.petrova@example.com',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        DB::table('sales_agents')->insert($agents);
    }
}
