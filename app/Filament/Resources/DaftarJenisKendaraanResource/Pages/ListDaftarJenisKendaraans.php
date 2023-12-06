<?php

namespace App\Filament\Resources\DaftarJenisKendaraanResource\Pages;

use App\Filament\Resources\DaftarJenisKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarJenisKendaraans extends ListRecords
{
    protected static string $resource = DaftarJenisKendaraanResource::class;
    protected static ?string $title = 'Jenis Kendaraan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Jenis Kendaraan')->icon('heroicon-o-plus'),
        ];
    }
}
