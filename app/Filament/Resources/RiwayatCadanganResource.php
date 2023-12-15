<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatCadanganResource\Pages;
use App\Filament\Resources\RiwayatCadanganResource\RelationManagers;
use App\Models\KendaraanSpesifikasi;
use App\Models\RiwayatCadangan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RiwayatCadanganResource extends Resource
{
    protected static ?string $model = RiwayatCadangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Riwayat Cadangan';
    protected static ?string $navigationGroup = 'Kendaraan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tgl')
                ->required()
                ->label('Tanggal Keluar'),

                Select::make('kendaraan_spesifikasi_id')
                ->required()
                ->relationship('kendaraan_spesifikasi', 'plat_nomor')
                ->label('Nopol Kendaraan Asal'),

                Select::make('nopol')
                ->options(KendaraanSpesifikasi::all()->pluck('plat_nomor', 'id'))
                ->label('Nopol kendaraan dipakai'),

                TextInput::make('driver')
                ->label('Driver kendaraan yang dipakai'),

                TextInput::make('alasan')
                ->label('Alasan pindah'),

                TextInput::make('keterangan')
                ->label('keterangan'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tgl')
                ->label('Tanggal dipakai')
                ->searchable()
                ->sortable(),

                TextColumn::make('kendaraan_spesifikasi.nopol')
                ->label('Nopol Asal')
                ->searchable()
                ->sortable()

            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListRiwayatCadangans::route('/'),
            'create' => Pages\CreateRiwayatCadangan::route('/create'),
            'edit' => Pages\EditRiwayatCadangan::route('/{record}/edit'),
        ];
    }
}
