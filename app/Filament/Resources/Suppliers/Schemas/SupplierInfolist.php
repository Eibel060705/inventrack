<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SupplierInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_perusahaan'),
                TextEntry::make('nama_kontak'),
                TextEntry::make('telepon'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('alamat')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
