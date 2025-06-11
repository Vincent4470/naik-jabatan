<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use Filament\Resources\Pages\CreateRecord;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreatePegawai extends CreateRecord
{
    protected static string $resource = PegawaiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kodeProvinsi = str_pad($data['id_provinsi'] ?? 0, 2, '0', STR_PAD_LEFT);
        $kodeKota = str_pad($data['id_kota_kabupaten'] ?? 0, 2, '0', STR_PAD_LEFT);
        $kodeKecamatan = str_pad($data['id_kecamatan'] ?? 0, 2, '0', STR_PAD_LEFT);
        $tglLahir = Carbon::parse($data['tanggal_lahir'])->format('Ymd');

        $count = Pegawai::where('id_provinsi', $data['id_provinsi'])
            ->where('id_kota_kabupaten', $data['id_kota_kabupaten'])
            ->where('id_kecamatan', $data['id_kecamatan'])
            ->whereDate('tanggal_lahir', $data['tanggal_lahir'])
            ->count();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        $data['nip'] = $kodeProvinsi . $kodeKota . $kodeKecamatan . $tglLahir . $nomorUrut;

        return $data;
    }

    protected function afterCreate(): void
    {
        $pegawai = $this->record;

        $formState = $this->form->getState();
        $password = $formState['password'];

        // Cek jika user belum ada untuk pegawai ini
        if (!User::where('id_pegawai', $pegawai->id_pegawai)->exists()) {
            User::create([
                'name' => $pegawai->nama,
                'username' => $pegawai->nip,
                'email' => $pegawai->email ?? $pegawai->nip . '@example.com',
                'password' => Hash::make($password),
                'id_role' => 1,
                'id_pegawai' => $pegawai->id_pegawai,
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
