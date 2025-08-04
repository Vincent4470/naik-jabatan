<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResource\Pages;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    // Saran: Kelompokkan menu di sidebar
    protected static ?string $navigationGroup = 'Manajemen Wilayah';

    // Saran: Beri label yang lebih rapi
    protected static ?string $modelLabel = 'Provinsi';
    protected static ?string $pluralModelLabel = 'Provinsi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_provinsi')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_provinsi')
                    ->label('ID')
                    ->sortable(), // <-- Saran: Tambahkan sortable
                Tables\Columns\TextColumn::make('nama_provinsi')
                    ->searchable(),
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
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}
