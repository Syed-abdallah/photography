<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: remove existing records first
        // DB::table('promotions')->truncate();

        $promotions = [
            [
                'name'       => 'Engagement Session Special',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Wedding Package Discount (10% Off)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Holiday Mini-Sessions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'New Year Portrait Promo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Refer-a-Friend Discount',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Seasonal Outdoor Shoot Special',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Studio Portrait Bundle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Social Media Package Promo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Free Photo Print with Booking',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Graduation Portrait Special',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('promotions')->insert($promotions);
    }
}
