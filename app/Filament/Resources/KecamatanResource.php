<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KecamatanResource\Pages;
use App\Filament\Resources\KecamatanResource\RelationManagers;
use App\Models\Kecamatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kota_kabupaten')
                    ->label('Kota/Kabupaten')
                    ->options(KotaKabupatenResource::pluck('nama_kota_kab', 'id_kota_kabupaten'))
                    ->required(),

                Forms\Components\TextInput::make('nama_kecamatan')
                    ->label('Nama Kecamatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kotaKabupaten.nama_kota_kab')->label('Kota/Kabupaten'),
                Tables\Columns\TextColumn::make('nama_kecamatan')->label('Nama Kecamatan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
