<?php

namespace App\Filament\Resources\DaftarJenisPerawatanResource\Pages;

use App\Filament\Resources\DaftarJenisPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarJenisPerawatans extends ListRecords
{
    protected static string $resource = DaftarJenisPerawatanResource::class;
    protected static ?string $title = 'Jenis-jenis Perawatan';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Jenis Perawatan')->icon('heroicon-o-plus'),
        ];
    }
}
