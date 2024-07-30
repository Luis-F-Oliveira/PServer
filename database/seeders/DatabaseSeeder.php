<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleOnUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory(1)->create();

        // Create admin role
        Role::factory(1)->create();

        // Apply admin in user
        RoleOnUser::factory(1)->create();
    }
}
