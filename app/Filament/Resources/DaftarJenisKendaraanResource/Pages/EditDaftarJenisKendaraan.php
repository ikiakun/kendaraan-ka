<?php

namespace App\Filament\Resources\DaftarJenisKendaraanResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DaftarJenisKendaraanResource;

class EditDaftarJenisKendaraan extends EditRecord
{
    protected static string $resource = DaftarJenisKendaraanResource::class;
    protected static ?string $title = 'Ubah Data Jenis Kendaraan';


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus Data')->icon('heroicon-o-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }




}
