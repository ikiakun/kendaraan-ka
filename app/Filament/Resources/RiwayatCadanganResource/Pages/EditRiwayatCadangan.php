<?php

namespace App\Filament\Resources\RiwayatCadanganResource\Pages;

use App\Filament\Resources\RiwayatCadanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatCadangan extends EditRecord
{
    protected static string $resource = RiwayatCadanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
