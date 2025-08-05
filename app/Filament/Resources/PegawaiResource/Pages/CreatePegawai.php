<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreatePegawai extends CreateRecord
{
    protected static string $resource = PegawaiResource::class;

    /**
     * FUNGSI UNTUK MEMBUAT NIP OTOMATIS
     * Fungsi ini berjalan sebelum data disimpan ke database.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil data dari form
        $kodeProvinsi = str_pad($data['id_provinsi'] ?? 0, 2, '0', STR_PAD_LEFT);
        $kodeKota = str_pad($data['id_kota_kabupaten'] ?? 0, 2, '0', STR_PAD_LEFT);
        $kodeKecamatan = str_pad($data['id_kecamatan'] ?? 0, 2, '0', STR_PAD_LEFT);
        $tglLahir = Carbon::parse($data['tanggal_lahir'])->format('Ymd');

        // Hitung jumlah pegawai yang ada dengan kriteria yang sama untuk nomor urut
        $count = Pegawai::where('id_provinsi', $data['id_provinsi'])
            ->where('id_kota_kabupaten', $data['id_kota_kabupaten'])
            ->where('id_kecamatan', $data['id_kecamatan'])
            ->whereDate('tanggal_lahir', $data['tanggal_lahir'])
            ->count();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Gabungkan semua menjadi NIP dan tambahkan ke data
        $data['nip'] = $kodeProvinsi . $kodeKota . $kodeKecamatan . $tglLahir . $nomorUrut;

        return $data;
    }

    /**
     * FUNGSI UNTUK MEMBUAT USER OTOMATIS
     * Fungsi ini berjalan setelah data pegawai berhasil dibuat.
     */
    protected function afterCreate(): void
    {
        $pegawai = $this->record;
        $formState = $this->form->getState();
        $password = $formState['password']; // Ambil password dari form

        // Tentukan Role berdasarkan level jabatan
        $level = $pegawai->jabatan?->level;
        $roleName = 'User'; // Default role

        if (in_array($level, [1, 2, 3])) {
            $roleName = 'Atasan';
        } elseif (in_array($level, [4, 5])) {
            $roleName = 'Hrd';
        }

        $id_role = RoleUser::where('nama_role', $roleName)->value('id_role');

        // Buat username dari jabatan dan nama
        $jabatanName = $pegawai->jabatan?->nama_jabatan ?? 'pegawai';
        $username = Str::slug($jabatanName . ' ' . $pegawai->nama);

        // Buat user baru dengan data yang benar
        User::create([
            'name' => $pegawai->nama,
            'username' => $username,
            'email' => $pegawai->email,
            'password' => Hash::make($password),
            'id_role' => $id_role,
            'id_pegawai' => $pegawai->id_pegawai,
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
