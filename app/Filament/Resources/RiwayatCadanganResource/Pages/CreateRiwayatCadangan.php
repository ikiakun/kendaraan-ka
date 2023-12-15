<?php

namespace App\Filament\Resources\RiwayatCadanganResource\Pages;

use App\Filament\Resources\RiwayatCadanganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRiwayatCadangan extends CreateRecord
{
    protected static string $resource = RiwayatCadanganResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
