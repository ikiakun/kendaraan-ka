<?php

namespace App\Filament\Resources\DaftarPerawatanResource\Pages;

use App\Filament\Resources\DaftarPerawatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarPerawatan extends CreateRecord
{
    protected static string $resource = DaftarPerawatanResource::class;
    protected static ?string $title = 'Buat Baru Data Perawatan';


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
