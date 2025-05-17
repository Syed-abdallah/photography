<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Role permissions
            [
                'name' => 'create role',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:34:40',
                'updated_at' => '2025-05-10 10:34:40',
            ],
            [
                'name' => 'view role',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:34:49',
                'updated_at' => '2025-05-10 10:34:49',
            ],
            [
                'name' => 'edit role',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:34:58',
                'updated_at' => '2025-05-10 10:34:58',
            ],
            [
                'name' => 'update role',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:34:58',
                'updated_at' => '2025-05-10 10:34:58',
            ],
            [
                'name' => 'delete role',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:35:06',
                'updated_at' => '2025-05-10 10:35:06',
            ],

            // Booking permissions
            [
                'name' => 'create booking',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:35:30',
                'updated_at' => '2025-05-10 10:35:30',
            ],
            [
                'name' => 'view booking',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:35:40',
                'updated_at' => '2025-05-10 10:35:40',
            ],
            [
                'name' => 'edit booking',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:35:49',
                'updated_at' => '2025-05-10 10:35:49',
            ],
            [
                'name' => 'update booking',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:35:49',
                'updated_at' => '2025-05-10 10:35:49',
            ],
            [
                'name' => 'delete booking',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:36:02',
                'updated_at' => '2025-05-10 10:36:02',
            ],

            // User permissions
            [
                'name' => 'create user',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:36:43',
                'updated_at' => '2025-05-10 10:36:43',
            ],
            [
                'name' => 'edit user',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:36:50',
                'updated_at' => '2025-05-10 10:36:50',
            ],
            [
                'name' => 'update user',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:36:50',
                'updated_at' => '2025-05-10 10:36:50',
            ],
            [
                'name' => 'view user',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:36:55',
                'updated_at' => '2025-05-10 10:36:55',
            ],
            [
                'name' => 'delete user',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:03',
                'updated_at' => '2025-05-10 10:37:03',
            ],

            // Saleagent permissions
            [
                'name' => 'create saleagent',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:18',
                'updated_at' => '2025-05-10 10:37:18',
            ],
            [
                'name' => 'edit saleagent',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:24',
                'updated_at' => '2025-05-10 10:37:24',
            ],
            [
                'name' => 'update saleagent',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:24',
                'updated_at' => '2025-05-10 10:37:24',
            ],
            [
                'name' => 'view saleagent',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:32',
                'updated_at' => '2025-05-10 10:37:32',
            ],
            [
                'name' => 'delete saleagent',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:39',
                'updated_at' => '2025-05-10 10:37:39',
            ],

            // Promotion permissions
            [
                'name' => 'create promotion',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:51',
                'updated_at' => '2025-05-10 10:37:51',
            ],
            [
                'name' => 'edit promotion',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:56',
                'updated_at' => '2025-05-10 10:37:56',
            ],
            [
                'name' => 'update promotion',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:37:56',
                'updated_at' => '2025-05-10 10:37:56',
            ],
            [
                'name' => 'view promotion',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:03',
                'updated_at' => '2025-05-10 10:38:03',
            ],
            [
                'name' => 'delete promotion',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:13',
                'updated_at' => '2025-05-10 10:38:13',
            ],

            // Services permissions
            [
                'name' => 'create services',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:24',
                'updated_at' => '2025-05-10 10:38:24',
            ],
            [
                'name' => 'edit services',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:30',
                'updated_at' => '2025-05-10 10:38:30',
            ],
            [
                'name' => 'update services',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:30',
                'updated_at' => '2025-05-10 10:38:30',
            ],
            [
                'name' => 'view services',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:40',
                'updated_at' => '2025-05-10 10:38:40',
            ],
            [
                'name' => 'delete services',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:38:51',
                'updated_at' => '2025-05-10 10:38:51',
            ],

            // Permission permissions
            [
                'name' => 'create permission',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:39:00',
                'updated_at' => '2025-05-10 10:39:00',
            ],
            [
                'name' => 'edit permission',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:39:07',
                'updated_at' => '2025-05-10 10:39:07',
            ],
            [
                'name' => 'update permission',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:39:07',
                'updated_at' => '2025-05-10 10:39:07',
            ],
            [
                'name' => 'view permission',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:39:15',
                'updated_at' => '2025-05-10 10:39:15',
            ],
            [
                'name' => 'delete permission',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:39:22',
                'updated_at' => '2025-05-10 10:39:22',
            ],

            // Register permissions
            [
                'name' => 'create register',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:42:09',
                'updated_at' => '2025-05-10 10:42:09',
            ],
            [
                'name' => 'edit register',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:42:16',
                'updated_at' => '2025-05-10 10:42:16',
            ],
            [
                'name' => 'update register',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:42:16',
                'updated_at' => '2025-05-10 10:42:16',
            ],
            [
                'name' => 'view register',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:42:27',
                'updated_at' => '2025-05-10 10:42:27',
            ],
            [
                'name' => 'delete register',
                'guard_name' => 'web',
                'created_at' => '2025-05-10 10:42:33',
                'updated_at' => '2025-05-10 10:42:33',
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}