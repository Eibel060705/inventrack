<?php

namespace App\Filament\Resources\Suppliers;

use App\Filament\Resources\Suppliers\Pages\CreateSupplier;
use App\Filament\Resources\Suppliers\Pages\EditSupplier;
use App\Filament\Resources\Suppliers\Pages\ListSuppliers;
use App\Filament\Resources\Suppliers\Pages\ViewSupplier;
use App\Filament\Resources\Suppliers\Schemas\SupplierInfolist;
use App\Filament\Resources\Suppliers\Tables\SuppliersTable;
use App\Models\Supplier;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_perusahaan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->placeholder('Contoh: PT. Sumber Makmur')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nama_kontak')
                    ->label('Nama Contact Person')
                    ->placeholder('Contoh: Budi Santoso')
                    ->required()
                    ->maxLength(255),

                TextInput::make('telepon')
                    ->label('Nomor Telepon')
                    ->placeholder('Contoh: 08123456789')
                    ->required()
                    ->maxLength(15),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->placeholder('Contoh: supplier@email.com')
                    ->required()
                    ->maxLength(255),

                Textarea::make('alamat')
                    ->label('Alamat Lengkap')
                    ->placeholder('Jl. Contoh No. 123, Kota, Provinsi')
                    ->required()
                    ->rows(3),

                FileUpload::make('image')
                    ->label('Foto Logo Perusahaan')
                    ->image()
                    ->disk('public')
                    ->directory('Suppiers')
                    ->visibility('public')
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SupplierInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuppliersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSuppliers::route('/'),
            'create' => CreateSupplier::route('/create'),
            'view' => ViewSupplier::route('/{record}'),
            'edit' => EditSupplier::route('/{record}/edit'),
        ];
    }
}