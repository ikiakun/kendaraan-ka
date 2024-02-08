<?php

namespace App\Filament\Resources;

use Filament\Forms;
use TextInput\Mask;
use Filament\Tables;
use App\Models\Solar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\HitunganSolar;
use Filament\Resources\Resource;
use App\Models\KendaraanSpesifikasi;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SolarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SolarResource\RelationManagers;
use Filament\Support\RawJs;

class SolarResource extends Resource
{
    protected static ?string $model = HitunganSolar::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-funnel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kendaraan_spesifikasi_id')
                    ->searchable()
                    ->options(KendaraanSpesifikasi::all()->pluck('nopol', 'id'))
                    ->required()
                    ->label('NOPOL')
                    ->columnSpan(1),

                Select::make('driver')
                    ->searchable()
                    ->options(KendaraanSpesifikasi::all()->pluck('driver', 'driver'))
                    ->required()
                    ->label('DRIVER')
                    ->columnSpan(1),

                DatePicker::make('tgl_awal')
                    ->label('Tanggal isi 1')
                    ->date()
                    ->required()
                    ->columnSpan(1),

                DatePicker::make('tgl_akhir')
                    ->label('Tanggal isi 2')
                    ->date()
                    ->columnSpan(1),

                TextInput::make('kilometer awal')
                    ->label('Kilometer Awal')
                    ->suffix('KM')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('kilometer akhir')
                    ->label('Kilometer Akhir')
                    ->suffix('KM')
                    ->reactive()
                    ->afterStateUpdated(function (\Filament\Forms\Set $set, $state, $get){
                        $kilometer_awal = $get('kilometer awal');
                        $jarak = $state - $kilometer_awal;
                        $jatah = 0;
                        $nopol = KendaraanSpesifikasi::where($get('nopol', 'id'))->first();
                        if ($nopol->kendaraan_jenis_id == 1) {
                            $jatah = ($state - $kilometer_awal) / 6;
                        } elseif ($nopol->kendaraan_jenis_id == 2) {
                            $jatah = ($state - $kilometer_awal) / 12;
                        } elseif ($nopol->kendaraan_jenis_id == 3) {
                            $jatah = ($state - $kilometer_awal) / 10;
                        } else {$jatah = ($state - $kilometer_awal) / 3;}
                        $set('kilometer jarak', Str::slug($jarak));
                        $set('solar_akhir', Str::slug($jatah));
                    })
                    ->columnSpan(1),

                TextInput::make('kilometer jarak')
                    ->label('Jarak Total')
                    ->suffix('KM')
                    ->columnSpan(2)
                    ->readOnly(),

                TextInput::make('solar_awal')
                    ->label('isi solar')
                    ->suffix('L')
                    ->numeric(),

                TextInput::make('solar_akhir')
                    ->label('Jatah Solar')
                    ->suffix('L')
                    // ->mask(RawJs::make(<<<'JS'
                    //     ->decimalPlaces(2),
                    //     ->decimalSeparator(,)
                    // JS))
                    ->numeric()
                    ->readOnly(),

                TextInput::make('tujuan')
                    ->label('Tujuan')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpan(1),


                Hidden::make('user_id')
                    ->default(Auth::user()->id)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolars::route('/'),
            'create' => Pages\CreateSolar::route('/create'),
            'view' => Pages\ViewSolar::route('/{record}'),
            'edit' => Pages\EditSolar::route('/{record}/edit'),
        ];
    }
}
