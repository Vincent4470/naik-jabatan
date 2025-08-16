<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanKenaikanResource\Pages;
use App\Models\PengajuanKenaikan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;

class PengajuanKenaikanResource extends Resource
{
    protected static ?string $model = PengajuanKenaikan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Manajemen Pengajuan';

    protected static ?string $modelLabel = 'Pengajuan Kenaikan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_pegawai')
                    ->label('Pegawai')
                    ->relationship('pegawai', 'nama')
                    ->required()
                    ->searchable()
                    ->preload(),
                Placeholder::make('jabatan_lama')
                    ->label('Jabatan Lama')
                    ->content(fn ($record) => $record?->pegawai?->jabatan?->nama_jabatan),
                Forms\Components\Select::make('id_jabatan_baru')
                    ->label('Jabatan Baru')
                    ->relationship('jabatanBaru', 'nama_jabatan')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\DatePicker::make('tanggal_pengajuan')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                Forms\Components\Select::make('id_status')
                    ->label('Status')
                    ->relationship('status', 'nama_status')
                    ->required(),
                Forms\Components\Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pegawai.nama')
                    ->label('Nama Pegawai')
                    ->searchable(),
                TextColumn::make('pegawai.jabatan.nama_jabatan')
                    ->label('Jabatan Lama')
                    ->searchable(),
                TextColumn::make('jabatanBaru.nama_jabatan')
                    ->label('Jabatan Baru')
                    ->searchable(),
                TextColumn::make('tanggal_pengajuan')
                    ->label('Tanggal Pengajuan')
                    ->date()
                    ->sortable(),
                TextColumn::make('status.nama_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Diajukan' => 'info',
                        'Dalam Penilaian' => 'warning',
                        'Menunggu Persetujuan' => 'warning',
                        'Disetujui' => 'success',
                        'Ditolak' => 'danger',
                        'Dibatalkan' => 'gray',
                        'Selesai' => 'success',
                        default => 'gray',
                    })
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPengajuanKenaikans::route('/'),
            'create' => Pages\CreatePengajuanKenaikan::route('/create'),
            'edit' => Pages\EditPengajuanKenaikan::route('/{record}/edit'),
        ];
    }
}
