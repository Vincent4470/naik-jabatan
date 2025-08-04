<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatePegawai extends CreateRecord
{
    protected static string $resource = PegawaiResource::class;

    /**
     * Override method ini untuk menggabungkan pembuatan Pegawai dan User.
     */
    protected function handleRecordCreation(array $data): Model
    {
        // 1. Buat data pegawai terlebih dahulu
        $pegawai = static::getModel()::create($data);

        // 2. Tentukan Role berdasarkan level jabatan
        $level = $pegawai->jabatan?->level;
        $roleName = 'User'; // Default role

        if (in_array($level, [1, 2, 3])) {
            $roleName = 'Atasan';
        } elseif (in_array($level, [4, 5])) {
            $roleName = 'Hrd';
        }

        $id_role = RoleUser::where('nama_role', $roleName)->value('id_role');

        // 3. PERBAIKAN: Buat username dari jabatan dan nama
        $jabatanName = $pegawai->jabatan?->nama_jabatan ?? 'pegawai';
        $username = Str::slug($jabatanName . ' ' . $pegawai->nama);

        // 4. Buat user baru dengan data yang benar
        User::create([
            'name' => $pegawai->nama,
            'username' => $username, // Menggunakan username yang baru
            'email' => $pegawai->email ?? $username . '@example.com',
            'password' => Hash::make('password'), // Password default
            'id_role' => $id_role,
            'id_pegawai' => $pegawai->id_pegawai,
        ]);

        return $pegawai;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
