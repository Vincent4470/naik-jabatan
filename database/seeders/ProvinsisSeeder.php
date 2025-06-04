<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsisSeeder extends Seeder
{
    public function run()
    {
        $provinsiList = [
            'ACEH',
            'SUMATERA UTARA',
            'SUMATERA BARAT',
            'RIAU',
            'JAMBI',
            'SUMATERA SELATAN',
            'BENGKULU',
            'LAMPUNG',
            'KEPULAUAN BANGKA BELITUNG',
            'KEPULAUAN RIAU',
            'DKI JAKARTA',
            'JAWA BARAT',
            'JAWA TENGAH',
            'DAERAH ISTIMEWA YOGYAKARTA',
            'JAWA TIMUR',
            'BANTEN',
            'BALI',
            'NUSA TENGGARA BARAT',
            'NUSA TENGGARA TIMUR',
            'KALIMANTAN BARAT',
            'KALIMANTAN TENGAH',
            'KALIMANTAN SELATAN',
            'KALIMANTAN TIMUR',
            'KALIMANTAN UTARA',
            'SULAWESI UTARA',
            'SULAWESI TENGAH',
            'SULAWESI SELATAN',
            'SULAWESI TENGGARA',
            'GORONTALO',
            'SULAWESI BARAT',
            'MALUKU',
            'MALUKU UTARA',
            'PAPUA',
            'PAPUA BARAT',
            'PAPUA SELATAN',
            'PAPUA TENGAH',
            'PAPUA PEGUNUNGAN',
            'PAPUA BARAT DAYA',
        ];

        $data = [];

        foreach ($provinsiList as $index => $nama) {
            $data[] = [
                'id_provinsi' => $index + 1,
                'nama_provinsi' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('provinsis')->insert($data);
    }
}
