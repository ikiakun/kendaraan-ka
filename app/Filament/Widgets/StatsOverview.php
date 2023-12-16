<?php

namespace App\Filament\Widgets;

use App\Models\KendaraanJenis;
use App\Models\KendaraanSpesifikasi;
use App\Models\Perawatan;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Jenis Kendaraan', KendaraanJenis::all()->count()),
            Stat::make('Total Data Kendaraan', KendaraanSpesifikasi::all()->count()),
            Stat::make('Total Data Perawatan Bulan ini', Perawatan::where(DB::raw('MONTH(tgl)'), Carbon::now()->month)->count()),
        ];
    }
}
