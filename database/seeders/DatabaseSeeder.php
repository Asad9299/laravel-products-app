<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Create Admin user
        if ( !User::where('email', 'admin@gmail.com')->exists() ) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678')
            ]);
            $user->roles()->attach($adminRole, ['created_at' => Carbon::now()]);
        }
    }
}
