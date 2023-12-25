<?php

namespace App\Filament\Resources\DaftarPerawatanResource\Pages;

use App\Filament\Resources\DaftarPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarPerawatan extends EditRecord
{
    protected static string $resource = DaftarPerawatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
