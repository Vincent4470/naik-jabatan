<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KotaKabupatenResource\Pages;
use App\Filament\Resources\KotaKabupatenResource\RelationManagers;
use App\Models\KotaKabupaten;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KotaKabupatenResource extends Resource
{
    protected static ?string $model = KotaKabupaten::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Kota/Kabupaten';
    protected static ?string $pluralModelLabel = 'Kota/Kabupaten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_provinsi')
                    ->label('Provinsi')
                    ->options(ProvinsiResource::pluck('nama_provinsi', 'id_provinsi'))
                    ->required(),

                Forms\Components\TextInput::make('nama_kota_kab')
                    ->label('Nama Kota/Kabupaten')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provinsi.nama_provinsi')->label('Provinsi'),
                Tables\Columns\TextColumn::make('nama_kota_kab')->label('Kota/Kabupaten'),
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
            'index' => Pages\ListKotaKabupatens::route('/'),
            'create' => Pages\CreateKotaKabupaten::route('/create'),
            'edit' => Pages\EditKotaKabupaten::route('/{record}/edit'),
        ];
    }
}
