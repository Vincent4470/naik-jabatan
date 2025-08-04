<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\RoleUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    // ... (kode untuk form() dan properti lainnya tetap sama) ...
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Nama')->required(),
                        Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)),
                    ])->columns(2),
                Forms\Components\Section::make('Keterkaitan & Role')
                    ->schema([
                        Forms\Components\Select::make('id_pegawai')
                            ->label('Pegawai (opsional)')
                            ->relationship('pegawai', 'nama')
                            ->searchable()
                            ->live()
                            ->nullable()
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $pegawai = Pegawai::with('jabatan')->find($state);
                                    if ($pegawai) {
                                        $set('name', $pegawai->nama);
                                        $set('email', $pegawai->email);
                                        $jabatanName = $pegawai->jabatan?->nama_jabatan ?? 'pegawai';
                                        $username = Str::slug($jabatanName . ' ' . $pegawai->nama);
                                        $set('username', $username);
                                    }
                                } else {
                                    $set('name', null);
                                    $set('username', null);
                                    $set('email', null);
                                }
                            }),
                        Forms\Components\Select::make('id_role')
                            ->label('Role Pengguna')
                            ->options(RoleUser::all()->pluck('nama_role', 'id_role'))
                            ->searchable()
                            ->required()
                            ->visible(fn (Get $get) => empty($get('id_pegawai'))),
                        Forms\Components\Placeholder::make('role_otomatis')
                            ->label('Role (Otomatis)')
                            ->content(function (Get $get) {
                                $pegawaiId = $get('id_pegawai');
                                if (!$pegawaiId) return 'Akan ditentukan otomatis.';
                                $pegawai = Pegawai::with('jabatan')->find($pegawaiId);
                                $level = $pegawai?->jabatan?->level;
                                if (in_array($level, [1, 2, 3])) return 'Atasan';
                                if (in_array($level, [4, 5])) return 'Hrd';
                                return 'User';
                            })
                            ->visible(fn (Get $get) => !empty($get('id_pegawai'))),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),

                // --- PERBAIKAN DI SINI ---
                // Menggunakan relasi berantai untuk mengambil nama jabatan
                Tables\Columns\TextColumn::make('pegawai.jabatan.nama_jabatan')
                    ->label('Jabatan')
                    ->placeholder('Tidak ada'), // Tampilkan jika user bukan pegawai

                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role.nama_role')->label('Role'),
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

    // ... (sisa kode lainnya tetap sama) ...
    protected static function mutateData(array $data): array
    {
        if (!empty($data['id_pegawai'])) {
            $pegawai = Pegawai::with('jabatan')->find($data['id_pegawai']);
            if ($pegawai) {
                $jabatanName = $pegawai->jabatan?->nama_jabatan ?? 'pegawai';
                $data['username'] = Str::slug($jabatanName . ' ' . $pegawai->nama);
                $level = $pegawai->jabatan?->level;
                $roleName = 'User';
                if (in_array($level, [1, 2, 3])) $roleName = 'Atasan';
                elseif (in_array($level, [4, 5])) $roleName = 'Hrd';
                $data['id_role'] = RoleUser::where('nama_role', $roleName)->value('id_role');
            }
        }
        return $data;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        return static::mutateData($data);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        return static::mutateData($data);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
