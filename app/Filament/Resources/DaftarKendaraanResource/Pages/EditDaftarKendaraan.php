<?php

namespace App\Filament\Resources\DaftarKendaraanResource\Pages;

use App\Filament\Resources\DaftarKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarKendaraan extends EditRecord
{
    protected static string $resource = DaftarKendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus data')->icon('heroicon-o-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
