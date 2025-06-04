<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: clear out existing rows
        // DB::table('services')->truncate();

     $services = [
    [ 'name' => 'Wedding Photography',           'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Portrait Photography',         'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Event Photography',            'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Product Photography',          'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Commercial Photography',       'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Real Estate Photography',      'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Food Photography',             'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Fashion Photography',          'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Drone / Aerial Photography',   'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Studio Rental (Photography)',  'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Photo Editing & Retouching',   'created_at' => now(), 'updated_at' => now() ],
    [ 'name' => 'Photography Consultation',     'created_at' => now(), 'updated_at' => now() ],
];


        DB::table('services')->insert($services);
    }
}
