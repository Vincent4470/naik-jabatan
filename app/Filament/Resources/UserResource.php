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
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Nama')->required(),
                        Forms\Components\TextInput::make('username')->required()->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->required(fn (string $context): bool => $context === 'create') // Wajib hanya saat membuat
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)),
                    ])->columns(2),

                Forms\Components\Section::make('Keterkaitan & Role')
                    ->schema([
                        Forms\Components\Select::make('id_pegawai')
                            ->label('Pegawai (opsional)')
                            ->relationship('pegawai', 'nama')
                            ->searchable()
                            ->live() // Memicu update form saat diubah
                            ->nullable(),

                        // Muncul hanya jika tidak ada pegawai yang dipilih
                        Forms\Components\Select::make('id_role')
                            ->label('Role Pengguna')
                            ->options(RoleUser::all()->pluck('nama_role', 'id_role'))
                            ->searchable()
                            ->required()
                            ->visible(fn (Get $get) => empty($get('id_pegawai'))),

                        // Muncul hanya jika ada pegawai yang dipilih
                        Forms\Components\Placeholder::make('role_otomatis')
                            ->label('Role (Otomatis)')
                            ->content(function (Get $get) {
                                $pegawaiId = $get('id_pegawai');
                                if (!$pegawaiId) {
                                    return 'Akan ditentukan otomatis setelah pegawai dipilih.';
                                }
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
                Tables\Columns\TextColumn::make('username')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role.nama_role')->label('Role'),
                Tables\Columns\TextColumn::make('pegawai.nama')->label('Pegawai Terkait')->placeholder('Tidak ada'),
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

    // Logika penentuan role otomatis dipindahkan ke sini
    public static function fillAndMutateFormData(array $data): array
    {
        // Jika ada pegawai yang dipilih, tentukan rolenya secara otomatis
        if (!empty($data['id_pegawai'])) {
            $pegawai = Pegawai::with('jabatan')->find($data['id_pegawai']);
            $level = $pegawai?->jabatan?->level;

            $roleName = 'User'; // Default
            if (in_array($level, [1, 2, 3])) {
                $roleName = 'Atasan';
            } elseif (in_array($level, [4, 5])) {
                $roleName = 'Hrd';
            }

            $data['id_role'] = RoleUser::where('nama_role', $roleName)->value('id_role');
        }

        return $data;
    }

    // Terapkan logika yang sama saat membuat record baru
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        return static::fillAndMutateFormData($data);
    }

    // Terapkan logika yang sama saat mengedit record
    public static function mutateFormDataBeforeSave(array $data): array
    {
        return static::fillAndMutateFormData($data);
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
