<?php

namespace App\Filament\Widgets;

use App\Models\KendaraanJenis;
use App\Models\KendaraanSpesifikasi;
use App\Models\Perawatan;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\warning;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Total Jenis Kendaraan', KendaraanJenis::all()->count()),
            Stat::make('Total Kendaraan', KendaraanSpesifikasi::all()->count() . ' Kendaraan'),
            Stat::make('Total Armada', KendaraanSpesifikasi::whereIn('kendaraan_jenis_id', [1,2,3,4])->count() . ' Armada'),
            Stat::make('Total Perawatan Selesai Bulan Ini', Perawatan::where(DB::raw('MONTH(tgl)'), Carbon::now()->month)->where('perawatan_status_id', '=', '1')->count() . ' Perbaikan'),
            Stat::make('Total perawatan yang masih diajukan bulan ini', Perawatan::where(DB::raw('MONTH(tgl)'), Carbon::now()->month)->where('perawatan_status_id', '=', '2')->count() . ' Perbaikan'),
        ];
    }
}
