<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_barang'),
                TextEntry::make('kode_barang'),
                TextEntry::make('stok')
                    ->numeric(),
                TextEntry::make('harga')
                    ->numeric(),
                TextEntry::make('kondisi'),
                TextEntry::make('lokasi'),
                TextEntry::make('deskripsi')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->columnSpanFull(),
                TextEntry::make('users_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
