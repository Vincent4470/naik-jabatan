<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JabatanResource\Pages;
use App\Filament\Resources\JabatanResource\RelationManagers;
use App\Models\Jabatan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class JabatanResource extends Resource
{
    protected static ?string $model = Jabatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $recordKeyName = 'id_jabatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_jabatan')
                    ->label('Nama Jabatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_jabatan')->label('Nama Jabatan'),

            TextColumn::make('pegawai_count')
                ->label('Jumlah Pegawai'),

            TextColumn::make('wilayah')
                ->label('Wilayah Terdaftar')
                ->getStateUsing(function ($record) {
                    $wilayah = $record->pegawai()
                        ->with(['provinsi', 'kota'])
                        ->get()
                        ->map(function ($pegawai) {
                            return $pegawai->kota->nama_kota_kab ?? $pegawai->provinsi->nama_provinsi ?? null;
                        })
                        ->filter()
                        ->unique()
                        ->values()
                        ->all();

                    return Str::limit(implode(', ', $wilayah), 50);
                })
                ->wrap(),
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
            'index' => Pages\ListJabatans::route('/'),
            'create' => Pages\CreateJabatan::route('/create'),
            'edit' => Pages\EditJabatan::route('/{record}/edit'),
        ];
    }
}
