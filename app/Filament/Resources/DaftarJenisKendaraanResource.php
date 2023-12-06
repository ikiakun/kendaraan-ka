<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarJenisKendaraanResource\Pages;
use App\Filament\Resources\DaftarJenisKendaraanResource\RelationManagers;
use App\Models\DaftarJenisKendaraan;
use App\Models\KendaraanJenis;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DaftarJenisKendaraanResource extends Resource
{
    protected static ?string $model = KendaraanJenis::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    protected static ?string $navigationLabel = 'Daftar Jenis Kendaraan';
    protected static ?int $navigationSort = 2;


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
            'index' => Pages\ListDaftarJenisKendaraans::route('/'),
            'create' => Pages\CreateDaftarJenisKendaraan::route('/create'),
            'edit' => Pages\EditDaftarJenisKendaraan::route('/{record}/edit'),
        ];
    }
}
