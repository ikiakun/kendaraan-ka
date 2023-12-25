<?php

namespace App\Filament\Resources\DaftarStatusPerawatanResource\Pages;

use App\Filament\Resources\DaftarStatusPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarStatusPerawatan extends CreateRecord
{
    protected static string $resource = DaftarStatusPerawatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
