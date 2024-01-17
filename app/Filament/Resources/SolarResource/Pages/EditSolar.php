<?php

namespace App\Filament\Resources\SolarResource\Pages;

use App\Filament\Resources\SolarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolar extends EditRecord
{
    protected static string $resource = SolarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
