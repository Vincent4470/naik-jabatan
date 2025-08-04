<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KotaKabupatenResource\Pages;
use App\Models\KotaKabupaten;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KotaKabupatenResource extends Resource
{
    protected static ?string $model = KotaKabupaten::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    // 2. Kelompokkan menu di sidebar
    protected static ?string $navigationGroup = 'Manajemen Wilayah';

    protected static ?string $modelLabel = 'Kota/Kabupaten';
    protected static ?string $pluralModelLabel = 'Kota/Kabupaten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_provinsi')
                    ->label('Provinsi')
                    // 3. Ambil data dari Model, bukan Resource
                    ->options(Provinsi::all()->pluck('nama_provinsi', 'id_provinsi'))
                    ->searchable() // Tambahkan fitur pencarian
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
                Tables\Columns\TextColumn::make('provinsi.nama_provinsi')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_kota_kab')
                    ->label('Kota/Kabupaten')
                    ->searchable(),
            ])
            ->filters([
                // 4. Tambahkan filter berdasarkan provinsi
                Tables\Filters\SelectFilter::make('id_provinsi')
                    ->relationship('provinsi', 'nama_provinsi')
                    ->label('Filter Provinsi')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKotaKabupatens::route('/'),
            'create' => Pages\CreateKotaKabupaten::route('/create'),
            'edit' => Pages\EditKotaKabupaten::route('/{record}/edit'),
        ];
    }
}
