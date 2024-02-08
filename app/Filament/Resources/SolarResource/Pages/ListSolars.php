<?php

namespace App\Filament\Resources\SolarResource\Pages;

use App\Filament\Resources\SolarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolars extends ListRecords
{
    protected static string $resource = SolarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Hitungan Solar')->icon('heroicon-o-plus'),
        ];
    }


}
