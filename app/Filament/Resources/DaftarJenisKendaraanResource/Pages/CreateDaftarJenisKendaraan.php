<?php

namespace App\Filament\Resources\DaftarJenisKendaraanResource\Pages;

use App\Filament\Resources\DaftarJenisKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarJenisKendaraan extends CreateRecord
{
    protected static string $resource = DaftarJenisKendaraanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
