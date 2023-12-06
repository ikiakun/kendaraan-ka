<?php

namespace App\Filament\Resources\DaftarJenisPerawatanResource\Pages;

use App\Filament\Resources\DaftarJenisPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarJenisPerawatan extends EditRecord
{
    protected static string $resource = DaftarJenisPerawatanResource::class;

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
