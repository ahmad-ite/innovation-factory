<?php

namespace Database\Seeders;

use App\Enums\User\UserPrefixnameEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
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
            'prefixname' => UserPrefixnameEnum::MR->value,
            'firstname' => 'Admin',
            // 'middlename' => null,
            'lastname' => 'Sys',
            // 'suffixname' => null,
            'username' => 'admin',
            // 'photo' => null,
            'email_verified_at' => now(),
            'password' => config('default.admin.password'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(10)->create();
    }
}
