<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KecamatanResource\Pages;
use App\Models\Kecamatan;
use App\Models\KotaKabupaten; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    // 2. Kelompokkan menu di sidebar
    protected static ?string $navigationGroup = 'Manajemen Wilayah';

    protected static ?string $modelLabel = 'Kecamatan';
    protected static ?string $pluralModelLabel = 'Kecamatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kota_kabupaten')
                    ->label('Kota/Kabupaten')
                    // 3. Ambil data dari Model, bukan Resource
                    ->options(KotaKabupaten::all()->pluck('nama_kota_kab', 'id_kota_kabupaten'))
                    ->searchable() // Tambahkan fitur pencarian
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
                Tables\Columns\TextColumn::make('kotaKabupaten.nama_kota_kab')
                    ->label('Kota/Kabupaten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_kecamatan')
                    ->label('Nama Kecamatan')
                    ->searchable(),
            ])
            ->filters([
                // 4. Tambahkan filter berdasarkan Kota/Kabupaten
                Tables\Filters\SelectFilter::make('id_kota_kabupaten')
                    ->relationship('kotaKabupaten', 'nama_kota_kab')
                    ->label('Filter Kota/Kabupaten')
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
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
