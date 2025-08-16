<?php

namespace App\Filament\Resources\PengajuanKenaikanResource\Pages;

use App\Filament\Resources\PengajuanKenaikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanKenaikan extends EditRecord
{
    protected static string $resource = PengajuanKenaikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
