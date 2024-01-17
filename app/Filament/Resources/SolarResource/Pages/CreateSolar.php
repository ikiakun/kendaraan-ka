<?php

namespace App\Filament\Resources\SolarResource\Pages;

use App\Filament\Resources\SolarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSolar extends CreateRecord
{
    protected static string $resource = SolarResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
