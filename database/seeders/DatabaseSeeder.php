<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\TestingSeeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\PostgresConnection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

        ]);

        // This code is related to the TestingSeeder execution.
        if (app()->environment(['local', 'staging', 'testing'])) {
            Schema::disableForeignKeyConstraints();
            if (DB::connection() instanceof SQLiteConnection) {
                DB::statement('PRAGMA FOREIGN_KEYS=0');
            } elseif (DB::connection() instanceof PostgresConnection) {
                DB::statement("SET session_replication_role = 'replica';");
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
            }

            $this->call(TestingSeeder::class);

            Schema::enableForeignKeyConstraints();
            if (DB::connection() instanceof SQLiteConnection) {
                DB::statement('PRAGMA FOREIGN_KEYS=1');
            } elseif (DB::connection() instanceof PostgresConnection) {
                DB::statement("SET session_replication_role = 'origin';");
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }
        }
    }
}