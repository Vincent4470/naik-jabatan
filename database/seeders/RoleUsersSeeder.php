<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_users')->insert([
            ['nama_role' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'User', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'Atasan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'Hrd', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
