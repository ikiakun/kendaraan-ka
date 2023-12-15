<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DaftarKendaraan;
use Filament\Resources\Resource;
use App\Models\KendaraanSpesifikasi;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DaftarKendaraanResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DaftarKendaraanResource\RelationManagers;
use Filament\Forms\Components\Field;

class DaftarKendaraanResource extends Resource
{
    protected static ?string $model = KendaraanSpesifikasi::class;
    protected static ?string $navigationLabel = 'Daftar Kendaraan';
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Kendaraan';
    // protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('plat_nomor')
                ->unique(ignoreRecord: true)
                    // ->startsWith('AG ')
                    ->label('Nopol')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('driver')
                    ->label('Nama Driver')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('nomor_rangka')
                ->unique(ignoreRecord: true)
                    ->label('No. Rangka')
                    ->required()
                    ->columnSpan(2),

                Select::make('kendaraan_jenis_id')
                    ->relationship('kendaraan_jenis', 'jenis')
                    ->label('Jenis Kendaraan')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('tahun')
                    ->label('Tahun')
                    ->placeholder('Contoh: 2021')
                    ->numeric()->minLength(4)->maxLength(4)
                    ->required()
                    ->columnSpan(1),

                TextInput::make('atas_nama')
                    ->label('Atas Nama')
                    ->placeholder('KAMU / MUKA')
                    ->columnSpan(1),

                DatePicker::make('berlaku_stnk')
                    ->label('Berlaku STNK')
                    ->required(),


                DatePicker::make('berlaku_kir')
                    ->label('Berlaku KIR')
                    ->required(),

                Hidden::make('user_id')
                    ->default(Auth::user()->id)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('driver')
                    ->label('Driver')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('plat_nomor')
                    ->label('Nopol')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nomor_rangka')
                    ->label('No. Rangka')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kendaraan_jenis.jenis')
                    ->label('Jenis')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('atas_nama')
                    ->label('Atas Nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('berlaku_stnk')
                    ->label('Berlaku STNK')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('berlaku_kir')
                    ->label('Berlaku KIR')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Dibuat/diubah oleh')
                    ->sortable()
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListDaftarKendaraans::route('/'),
            'create' => Pages\CreateDaftarKendaraan::route('/create'),
            'edit' => Pages\EditDaftarKendaraan::route('/{record}/edit'),
        ];
    }
}
