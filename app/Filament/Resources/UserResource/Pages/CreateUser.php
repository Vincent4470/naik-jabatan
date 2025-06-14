<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Pegawai;
use App\Models\RoleUser;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Mapping otomatis Role berdasarkan Jabatan Pegawai
        if (isset($data['id_pegawai']) && $data['id_pegawai']) {
            $pegawai = Pegawai::with('jabatan')->find($data['id_pegawai']);
            $level = $pegawai?->jabatan?->level;

            if ($level === 1 || $level === 2 || $level === 3) {
                $data['id_role'] = RoleUser::where('nama_role', 'Atasan')->value('id_role');
            } elseif ($level === 4 || $level === 5) {
                $data['id_role'] = RoleUser::where('nama_role', 'Hrd')->value('id_role');
            } else {
                $data['id_role'] = RoleUser::where('nama_role', 'User')->value('id_role');
            }
        } else {
            // Default role jika tidak ada pegawai
            $data['id_role'] = RoleUser::where('nama_role', 'User')->value('id_role');
        }

        return $data;
    }
}
