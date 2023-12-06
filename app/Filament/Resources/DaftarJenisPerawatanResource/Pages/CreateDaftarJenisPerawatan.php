<?php

namespace App\Filament\Resources\DaftarJenisPerawatanResource\Pages;

use App\Filament\Resources\DaftarJenisPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarJenisPerawatan extends CreateRecord
{
    protected static string $resource = DaftarJenisPerawatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
