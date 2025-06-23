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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Hidden;


class UserResource extends Resource
{
    protected static ?string $model = User::class; 
protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama')->required(),
                TextInput::make('username')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(fn(string $context) => $context === 'create')
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state)),

                Select::make('id_pegawai')
                    ->label('Pegawai (opsional)')
                    ->options(Pegawai::pluck('nama', 'id_pegawai'))
                    ->searchable()
                    ->nullable(),

                Placeholder::make('role_info')
                    ->label('Role (otomatis)')
                    ->content(fn($record) => $record?->role?->nama_role ?? 'Akan ditentukan otomatis'),

                // 🔥 Tambahkan ini!
                Hidden::make('id_role')
                    ->default(null)
                    ->dehydrated(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('username'),
                TextColumn::make('email'),
                TextColumn::make('role.nama_role')->label('Role'),
                TextColumn::make('pegawai.nama')->label('Pegawai'),
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

    // UserResource.php
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
