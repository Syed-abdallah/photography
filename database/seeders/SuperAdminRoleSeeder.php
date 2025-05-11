<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Step 1: Create the 'Super Admin' Role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'Super Admin']);

        // Step 2: Retrieve the user (Change this as needed)
        $user = User::find(1); // OR use: User::where('email', 'admin@example.com')->first();

        if ($user) {
            // Step 3: Manually insert into model_has_roles if not already assigned
            DB::table('model_has_roles')->updateOrInsert(
                [
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user->id
                ],
                [] // No additional columns to update
            );
        }
    }

}
