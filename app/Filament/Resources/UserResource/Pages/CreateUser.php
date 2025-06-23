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
        $role = 'User'; // Default role

        if (!empty($data['id_pegawai'])) {
            $pegawai = Pegawai::with('jabatan')->find($data['id_pegawai']);
            $level = $pegawai?->jabatan?->level;

            if (in_array($level, [1, 2, 3])) {
                $role = 'Atasan';
            } elseif (in_array($level, [4, 5])) {
                $role = 'Hrd';
            }
        }

        $data['id_role'] = RoleUser::where('nama_role', $role)->value('id_role');

        return $data;
    }
}
