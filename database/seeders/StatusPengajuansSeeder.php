<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPengajuansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $statusList = [
            'Diajukan',              // diajukan oleh pegawai
            'Dalam Penilaian',       // dinilai oleh HRD atau tim penilai
            'Menunggu Persetujuan',  // menunggu atasan untuk setuju
            'Disetujui',             // pengajuan disetujui
            'Ditolak',               // pengajuan ditolak
            'Dibatalkan',            // pengajuan dibatalkan
            'Selesai',               // proses kenaikan sudah selesai
        ];

        $data = [];

        foreach ($statusList as $index => $namaStatus) {
            $data[] = [
                'id_status' => $index + 1, // bisa otomatis juga kalau autoincrement
                'nama_status' => $namaStatus,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('status_pengajuans')->insert($data);
    }
}
