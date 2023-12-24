<?php

namespace App\Filament\Resources\RiwayatCadanganResource\Pages;

use App\Filament\Resources\RiwayatCadanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiwayatCadangans extends ListRecords
{
    protected static string $resource = RiwayatCadanganResource::class;
    protected static ?string $title = 'Riwayat Cadangan';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Penggunaan Cadangan')->icon('heroicon-o-plus'),
        ];
    }
}
