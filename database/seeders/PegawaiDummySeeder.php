<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PegawaiDummySeeder extends Seeder
{
    public function run()
    {
        $pegawaiDummy = [
            [
                'nama' => 'Budi Santoso',
                'tanggal_lahir' => '1985-05-10',
                'email' => 'budi.s@example.com',
                'id_jabatan' => 6,
                'unit_kerja' => 'Divisi Kepegawaian',
                'id_provinsi' => 12,
                'id_kota_kabupaten' => 147,
                'id_kecamatan' => 1251,
                'tanggal_mulai' => '2015-08-01',
                'password_user' => 'password123',
            ],
            [
                'nama' => 'Siti Aminah',
                'tanggal_lahir' => '1990-11-20',
                'email' => 'siti.a@example.com',
                'id_jabatan' => 9,
                'unit_kerja' => 'Divisi Keuangan',
                'id_provinsi' => 13,
                'id_kota_kabupaten' => 174,
                'id_kecamatan' => 1500,
                'tanggal_mulai' => '2018-03-15',
                'password_user' => 'password123',
            ],
        ];

        foreach ($pegawaiDummy as $data) {
            $nip = str_pad($data['id_provinsi'] ?? 0, 2, '0', STR_PAD_LEFT)
                . str_pad($data['id_kota_kabupaten'] ?? 0, 2, '0', STR_PAD_LEFT)
                . str_pad($data['id_kecamatan'] ?? 0, 2, '0', STR_PAD_LEFT)
                . Carbon::parse($data['tanggal_lahir'])->format('Ymd')
                . str_pad(Pegawai::count() + 1, 3, '0', STR_PAD_LEFT);

            $pegawai = Pegawai::create([
                'nama' => $data['nama'],
                'nip' => $nip,
                'tanggal_lahir' => $data['tanggal_lahir'],
                'email' => $data['email'],
                'unit_kerja' => $data['unit_kerja'],
                'id_jabatan' => $data['id_jabatan'],
                'id_provinsi' => $data['id_provinsi'],
                'id_kota_kabupaten' => $data['id_kota_kabupaten'],
                'id_kecamatan' => $data['id_kecamatan'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'alamat' => 'Alamat ' . $data['nama'],
            ]);

            $pegawai->refresh();
            $level = $pegawai->jabatan?->level;
            $roleName = 'User';
            if (in_array($level, [1, 2, 3])) {
                $roleName = 'Atasan';
            } elseif (in_array($level, [4, 5])) {
                $roleName = 'Hrd';
            }
            $id_role = RoleUser::where('nama_role', $roleName)->value('id_role');

            User::create([
                'name' => $pegawai->nama,
                'username' => Str::slug($pegawai->nama),
                'email' => $pegawai->email,
                'password' => Hash::make($data['password_user']),
                'id_role' => $id_role,
                'id_pegawai' => $pegawai->id_pegawai,
            ]);
        }
    }
}
