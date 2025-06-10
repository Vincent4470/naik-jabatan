<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Set primary key yang dipakai model
    protected static ?string $recordKeyName = 'id_pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->nullable(),

                Forms\Components\TextInput::make('unit_kerja')
                    ->nullable(),

                Forms\Components\Select::make('id_provinsi')
                    ->label('Provinsi')
                    ->options(fn() => DB::table('provinsis')->pluck('nama_provinsi', 'id_provinsi')->toArray())
                    ->nullable()
                    ->reactive(),

                Forms\Components\Select::make('id_kota_kabupaten')
                    ->label('Kota/Kabupaten')
                    ->options(function (callable $get) {
                        $provinsiId = $get('id_provinsi');
                        if (!$provinsiId) {
                            return [];
                        }
                        return DB::table('kota_kabupatens')
                            ->where('id_provinsi', $provinsiId)
                            ->pluck('nama_kota_kab', 'id_kota_kabupaten')
                            ->toArray();
                    })
                    ->nullable()
                    ->reactive(),

                Forms\Components\Select::make('id_kecamatan')
                    ->label('Kecamatan')
                    ->options(function (callable $get) {
                        $kotaId = $get('id_kota_kabupaten');
                        if (!$kotaId) {
                            return [];
                        }
                        return DB::table('kecamatans')
                            ->where('id_kota_kabupaten', $kotaId)
                            ->pluck('nama_kecamatan', 'id_kecamatan')
                            ->toArray();
                    })
                    ->nullable(),

                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->nullable(),

                Forms\Components\TextInput::make('nip')
                    ->disabled()
                    ->readOnly()
                    ->label('NIP')
                    ->placeholder('Akan digenerate otomatis'),


                Forms\Components\TextInput::make('password')
                    ->label('Password User')
                    ->password()
                    ->required()
                    ->dehydrated()
                    ->dehydrateStateUsing(fn($state) => $state),

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('nip')->label('NIP'),
                Tables\Columns\TextColumn::make('provinsi.nama_provinsi')->label('Provinsi'),
                Tables\Columns\TextColumn::make('kota.name_kota_kab')->label('Kota/Kabupaten'),
                Tables\Columns\TextColumn::make('kecamatan.name_kecamatan')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date()->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('user.username')->label('Username'),
                Tables\Columns\TextColumn::make('user.email')->label('Email'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }
}
