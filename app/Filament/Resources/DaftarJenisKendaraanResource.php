<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KendaraanJenis;
use Filament\Resources\Resource;
use App\Models\DaftarJenisKendaraan;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DaftarJenisKendaraanResource\Pages;
use App\Filament\Resources\DaftarJenisKendaraanResource\RelationManagers;

class DaftarJenisKendaraanResource extends Resource
{
    protected static ?string $model = KendaraanJenis::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    protected static ?string $navigationLabel = 'Daftar Jenis Kendaraan';
    protected static ?string $navigationGroup = 'Kendaraan';
    // protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jenis')
                ->required()
                ->columnSpan(2),

                Hidden::make('user_id')
                ->default(Auth::user()->id)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis')
                ->label('Jenis')
                ->sortable(),

                TextColumn::make('user.name')
                ->label('Dibuat/diubah oleh')
                ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDaftarJenisKendaraans::route('/'),
            'create' => Pages\CreateDaftarJenisKendaraan::route('/create'),
            'edit' => Pages\EditDaftarJenisKendaraan::route('/{record}/edit'),
        ];
    }
}
