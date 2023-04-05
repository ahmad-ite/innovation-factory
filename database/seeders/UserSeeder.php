<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create if not found by email check
        User::firstOrCreate([
            'email' => config('default.admin.email'),
        ], [
            'prefixname' => 'Mr',
            'firstname' => 'Admin',
            // 'middlename' => null,
            'lastname' => 'Sys',
            // 'suffixname' => null,
            'username' => 'admin',
            // 'photo' => null,
            'email_verified_at' => now(),
            'password' => Hash::make(config('default.admin.password')),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(20)->create();
    }
}
