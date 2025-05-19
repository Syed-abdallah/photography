<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           $this->call([
    UserSeeder::class,
    // other seeders...
]);

        // $this->call([
        //     PermissionSeeder::class,
        // ]);
        $this->call(SuperAdminRoleSeeder::class);

    }
}
