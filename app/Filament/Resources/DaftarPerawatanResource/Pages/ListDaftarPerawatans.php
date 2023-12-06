<?php

namespace App\Filament\Resources\DaftarPerawatanResource\Pages;

use App\Filament\Resources\DaftarPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarPerawatans extends ListRecords
{
    protected static string $resource = DaftarPerawatanResource::class;
    protected static ?string $title = 'Daftar Perawatan';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Data Perawatan')->icon('heroicon-o-plus'),
        ];
    }
}
