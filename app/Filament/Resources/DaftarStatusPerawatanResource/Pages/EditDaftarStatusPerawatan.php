<?php

namespace App\Filament\Resources\DaftarStatusPerawatanResource\Pages;

use App\Filament\Resources\DaftarStatusPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarStatusPerawatan extends EditRecord
{
    protected static string $resource = DaftarStatusPerawatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
