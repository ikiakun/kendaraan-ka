<?php

namespace App\Filament\Resources\DaftarKendaraanResource\Pages;

use App\Filament\Resources\DaftarKendaraanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarKendaraan extends CreateRecord
{
    protected static string $resource = DaftarKendaraanResource::class;
    protected static ?string $title = 'Buat Baru Data Kendaraan';


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
