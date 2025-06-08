<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jabatanList = [
            ['nama_jabatan' => 'Sekretaris Jenderal', 'level' => 1],
            ['nama_jabatan' => 'Direktur Jenderal', 'level' => 2],
            ['nama_jabatan' => 'Inspektur Jenderal', 'level' => 2],
            ['nama_jabatan' => 'Kepala Biro', 'level' => 3],
            ['nama_jabatan' => 'Direktur', 'level' => 3],
            ['nama_jabatan' => 'Kepala Bagian', 'level' => 4],
            ['nama_jabatan' => 'Kepala Subbagian', 'level' => 5],
            ['nama_jabatan' => 'Kepala Seksi', 'level' => 5],
            ['nama_jabatan' => 'Analis Kebijakan Ahli Madya', 'level' => 6],
            ['nama_jabatan' => 'Analis Kebijakan Ahli Muda', 'level' => 7],
            ['nama_jabatan' => 'Analis Kebijakan Ahli Pertama', 'level' => 8],
            ['nama_jabatan' => 'Staf Administrasi Umum', 'level' => 9],
        ];

        foreach ($jabatanList as $jabatan) {
            DB::table('jabatans')->insert([
                'nama_jabatan' => $jabatan['nama_jabatan'],
                'level' => $jabatan['level'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
