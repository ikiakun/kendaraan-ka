<?php

namespace App\Filament\Resources\DaftarKendaraanResource\Pages;

use App\Filament\Resources\DaftarKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarKendaraans extends ListRecords
{
    protected static string $resource = DaftarKendaraanResource::class;
    protected static ?string $title = 'Daftar Kendaraan';


    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Kendaraan')->icon('heroicon-o-plus'),

        ];
    }
}
