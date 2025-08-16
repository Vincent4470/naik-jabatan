<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\PengajuanKenaikan;
use App\Models\StatusPengajuan;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PengajuanKenaikanDummySeeder extends Seeder
{
    public function run()
    {
        $pegawaiBudi = Pegawai::where('nama', 'Budi Santoso')->first();
        $pegawaiSiti = Pegawai::where('nama', 'Siti Aminah')->first();

        // Buat data Rudi dan Andi secara manual
        $pegawaiRudi = Pegawai::create([
            'nama' => 'Rudi Gunawan',
            'email' => 'rudi.g@example.com',
            'nip' => '01020319920101001',
            'tanggal_lahir' => '1992-01-01',
            'unit_kerja' => 'Divisi Kepegawaian',
            'id_jabatan' => 10, // Analis Kebijakan Ahli Muda
            'alamat' => 'Alamat Rudi',
        ]);
        User::create([
            'name' => $pegawaiRudi->nama,
            'username' => Str::slug($pegawaiRudi->nama),
            'email' => $pegawaiRudi->email,
            'password' => Hash::make('password123'),
            'id_role' => RoleUser::where('nama_role', 'User')->value('id_role'),
            'id_pegawai' => $pegawaiRudi->id_pegawai,
        ]);

        $pegawaiAndi = Pegawai::create([
            'nama' => 'Andi Pratama',
            'email' => 'andi.p@example.com',
            'nip' => '01020319950505002',
            'tanggal_lahir' => '1995-05-05',
            'unit_kerja' => 'Divisi Keuangan',
            'id_jabatan' => 11, // Analis Kebijakan Ahli Pertama
            'alamat' => 'Alamat Andi',
        ]);
         User::create([
            'name' => $pegawaiAndi->nama,
            'username' => Str::slug($pegawaiAndi->nama),
            'email' => $pegawaiAndi->email,
            'password' => Hash::make('password123'),
            'id_role' => RoleUser::where('nama_role', 'User')->value('id_role'),
            'id_pegawai' => $pegawaiAndi->id_pegawai,
        ]);

        // Ambil ID jabatan untuk pengajuan
        $jabatanKepalaBagian = Jabatan::where('nama_jabatan', 'Kepala Bagian')->first();
        $jabatanKepalaSeksi = Jabatan::where('nama_jabatan', 'Kepala Seksi')->first();
        $jabatanAnalisMadya = Jabatan::where('nama_jabatan', 'Analis Kebijakan Ahli Madya')->first();
        $jabatanAnalisMuda = Jabatan::where('nama_jabatan', 'Analis Kebijakan Ahli Muda')->first();

        // Ambil ID semua status pengajuan
        $statusDiajukan = StatusPengajuan::where('nama_status', 'Diajukan')->first()->id_status;
        $statusDalamPenilaian = StatusPengajuan::where('nama_status', 'Dalam Penilaian')->first()->id_status;
        $statusMenungguPersetujuan = StatusPengajuan::where('nama_status', 'Menunggu Persetujuan')->first()->id_status;
        $statusDisetujui = StatusPengajuan::where('nama_status', 'Disetujui')->first()->id_status;
        $statusDitolak = StatusPengajuan::where('nama_status', 'Ditolak')->first()->id_status;
        $statusDibatalkan = StatusPengajuan::where('nama_status', 'Dibatalkan')->first()->id_status;
        $statusSelesai = StatusPengajuan::where('nama_status', 'Selesai')->first()->id_status;

        // Buat pengajuan dengan berbagai status
        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiBudi->id_pegawai,
            'id_jabatan_baru' => $jabatanKepalaSeksi->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subMonths(3),
            'id_status' => $statusDiajukan,
            'catatan' => 'Pengajuan awal, menunggu verifikasi HRD.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiSiti->id_pegawai,
            'id_jabatan_baru' => $jabatanKepalaBagian->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subMonths(2),
            'id_status' => $statusDalamPenilaian,
            'catatan' => 'Dokumen sudah lengkap, sedang dalam tahap penilaian oleh tim HRD.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiRudi->id_pegawai,
            'id_jabatan_baru' => $jabatanAnalisMadya->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subWeeks(3),
            'id_status' => $statusMenungguPersetujuan,
            'catatan' => 'Hasil penilaian sudah selesai, menunggu persetujuan dari atasan.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiAndi->id_pegawai,
            'id_jabatan_baru' => $jabatanAnalisMuda->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subWeeks(1),
            'id_status' => $statusDisetujui,
            'catatan' => 'Pengajuan telah disetujui, menunggu SK dikeluarkan.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiBudi->id_pegawai,
            'id_jabatan_baru' => $jabatanAnalisMuda->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subWeeks(4),
            'id_status' => $statusDitolak,
            'catatan' => 'Ditolak karena tidak memenuhi kriteria kinerja tahunan.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiSiti->id_pegawai,
            'id_jabatan_baru' => $jabatanKepalaSeksi->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subMonths(1),
            'id_status' => $statusDibatalkan,
            'catatan' => 'Dibatalkan oleh pegawai yang bersangkutan.',
        ]);

        PengajuanKenaikan::create([
            'id_pegawai' => $pegawaiRudi->id_pegawai,
            'id_jabatan_baru' => $jabatanAnalisMadya->id_jabatan,
            'tanggal_pengajuan' => Carbon::now()->subMonths(5),
            'id_status' => $statusSelesai,
            'catatan' => 'Kenaikan jabatan sudah selesai dan SK telah diterbitkan.',
        ]);
    }
}
