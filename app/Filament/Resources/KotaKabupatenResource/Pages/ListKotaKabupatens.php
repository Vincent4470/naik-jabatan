<?php

namespace App\Filament\Resources\KotaKabupatenResource\Pages;

use App\Filament\Resources\KotaKabupatenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKotaKabupatens extends ListRecords
{
    protected static string $resource = KotaKabupatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
