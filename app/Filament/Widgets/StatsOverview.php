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
            // Stat::make('Total Jenis Kendaraan', KendaraanJenis::all()->count()),
            Stat::make('Total Data Kendaraan', KendaraanSpesifikasi::whereIn('kendaraan_jenis_id', [1,2,3,4])->count() . ' Kendaraan'),
            Stat::make('Total Armada', KendaraanSpesifikasi::where('kendaraan_jenis_id', '=', '1')
                // ->where('kendaraan_jenis_id', '=', '2')
                // ->where('kendaraan_jenis_id', '=', '3')
                // ->where('kendaraan_jenis_id', '=', '4')
                ->count() . ' Armada'),
            Stat::make('Total Data Perawatan Bulan ini', Perawatan::where(DB::raw('MONTH(tgl)'), Carbon::now()->month)->count()),
        ];
    }
}
