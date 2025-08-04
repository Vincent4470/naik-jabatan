<?php

namespace App\Filament\Resources\JabatanResource\Pages;

use App\Filament\Resources\JabatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder; // Pastikan ini diimpor

class ListJabatans extends ListRecords
{
    protected static string $resource = JabatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * Memuat penghitungan jumlah pegawai secara efisien.
     * Pastikan nama relasi di sini adalah 'pegawais' (jamak).
     */
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withCount('pegawais');
    }
}
