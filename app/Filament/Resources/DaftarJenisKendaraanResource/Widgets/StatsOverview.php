<?php

namespace App\Filament\Resources\DaftarJenisKendaraanResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('jenis', 'nama')
        ];
    }
}
