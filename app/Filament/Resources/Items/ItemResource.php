<?php

namespace App\Filament\Resources\Items;

use App\Filament\Resources\Items\Pages\CreateItem;
use App\Filament\Resources\Items\Pages\EditItem;
use App\Filament\Resources\Items\Pages\ListItems;
use App\Filament\Resources\Items\Pages\ViewItem;
use App\Filament\Resources\Items\Schemas\ItemInfolist;
use App\Filament\Resources\Items\Tables\ItemsTable;
use App\Models\Item;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_barang';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->placeholder('Contoh: Laptop Lenovo ThinkPad')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->placeholder('Contoh: BRG-001')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('stok')
                    ->label('Jumlah Stok')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('harga')
                    ->label('Harga Satuan (Rp)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->prefix('Rp'),

                Select::make('kondisi')
                    ->label('Kondisi Barang')
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Rusak Berat' => 'Rusak Berat',
                    ])
                    ->required(),

                Select::make('lokasi')
                    ->label('Lokasi Penyimpanan')
                    ->options([
                        'Gudang A' => 'Gudang A',
                        'Gudang B' => 'Gudang B',
                        'Gudang C' => 'Gudang C',
                    ])
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Barang')
                    ->placeholder('Jelaskan detail barang ini')
                    ->required()
                    ->rows(3),

                FileUpload::make('image')
                    ->label('Foto Barang')
                    ->image()
                    ->disk('public')
                    ->directory('items')
                    ->visibility('public')
                    ->required(),

                Hidden::make('users_id'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItems::route('/'),
            'create' => CreateItem::route('/create'),
            'view' => ViewItem::route('/{record}'),
            'edit' => EditItem::route('/{record}/edit'),
        ];
    }
}