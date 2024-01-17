<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatCadanganResource\Pages;
use App\Filament\Resources\RiwayatCadanganResource\RelationManagers;
use App\Models\KendaraanSpesifikasi;
use App\Models\RiwayatCadangan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

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
                    ->label('Tanggal Keluar')
                    ->default(now()),

                Select::make('nopol')
                    ->required()
                    ->options(KendaraanSpesifikasi::all()->pluck('nopol', 'nopol'))
                    ->searchable()
                    ->label('Nopol kendaraan yang dipinjam'),

                Select::make('driver')
                    ->options(KendaraanSpesifikasi::all()->pluck('driver', 'driver'))
                    ->required()
                    ->searchable()
                    ->label('Driver yang meminjam'),

                TextInput::make('alasan')
                    ->label('Alasan pindah')
                    ->required(),

                TextInput::make('keterangan')
                    ->label('keterangan')
                    ->columnSpan(2),

                Hidden::make('user_id')
                    ->default(Auth::user()->id)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tgl')
                    ->label('Tanggal dipakai')
                    ->date('d M y')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nopol')
                    ->label('Nopol Kendaraan Cadangan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('driver')
                    ->label('Driver yang Bawa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alasan')
                    ->label('Alasan Pinjam')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable()
                    ->sortable(),

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
