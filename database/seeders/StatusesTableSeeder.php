<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // (Optional) Truncate first if you want to start fresh each time:
        // DB::table('statuses')->truncate();

      $statuses = [
    ['name' => 'Pending',         'color' => '#FFC107', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Approved',        'color' => '#28A745', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Rejected',        'color' => '#DC3545', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'In Progress',     'color' => '#17A2B8', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Completed',       'color' => '#007BFF', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'On Hold',         'color' => '#6C757D', 'created_at' => now(), 'updated_at' => now()], // gray
    ['name' => 'Cancelled',       'color' => '#343A40', 'created_at' => now(), 'updated_at' => now()], // dark gray
    ['name' => 'Failed',          'color' => '#E74C3C', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Expired',         'color' => '#FF5733', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Scheduled',       'color' => '#20C997', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Draft',           'color' => '#6F42C1', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Reviewed',        'color' => '#6610F2', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Archived',        'color' => '#ADB5BD', 'created_at' => now(), 'updated_at' => now()], // light gray
    ['name' => 'Under Review',    'color' => '#FD7E14', 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Needs Revision',  'color' => '#FFC107', 'created_at' => now(), 'updated_at' => now()],
];


        DB::table('statuses')->insert($statuses);
    }
}
