<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaKabupatensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kotaKabList = [
            // 'KOTA MEDAN',
            // Tambah sesuai data 
        ];

        $data = [];

        foreach ($kotaKabList as $index => $nama) {
            $data[] = [
                'id_kota_kabupaten' => $index + 1,  // opsional, bisa dihapus kalau auto increment
                'nama_kota_kab' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('kota_kabupatens')->insert($data);
    }
}
