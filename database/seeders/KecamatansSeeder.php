<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kecamatanList = [
            // 'Medan Kota',
            // tambah sesuai data 
        ];

        $data = [];

        foreach ($kecamatanList as $index => $nama) {
            $data[] = [
                'id_kecamatan' => $index + 1, // atau kamu bisa hapus ini jika auto increment
                'nama_kecamatan' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('kecamatans')->insert($data);
    }
}
