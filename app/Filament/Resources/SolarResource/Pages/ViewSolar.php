<?php

namespace App\Filament\Resources\SolarResource\Pages;

use App\Filament\Resources\SolarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSolar extends ViewRecord
{
    protected static string $resource = SolarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
