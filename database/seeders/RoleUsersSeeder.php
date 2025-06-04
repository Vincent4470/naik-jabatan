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
            ['nama_role' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'atasan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'hrd', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
