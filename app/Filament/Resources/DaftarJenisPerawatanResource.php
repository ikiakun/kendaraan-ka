<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PerawatanJenis;
use Filament\Resources\Resource;
use function Laravel\Prompts\text;
use App\Models\DaftarJenisPerawatan;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DaftarJenisPerawatanResource\Pages;
use App\Filament\Resources\DaftarJenisPerawatanResource\RelationManagers;

class DaftarJenisPerawatanResource extends Resource
{
    protected static ?string $model = PerawatanJenis::class;
    protected static ?string $navigationLabel = 'Daftar Jenis Perawatan';
    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';
    protected static ?string $navigationGroup = 'Perawatan';

    // protected static ?int $navigationSort = 3;


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
                ->label('Jenis Perawatan')
                ->sortable()
                ->searchable(),

                TextColumn::make('user.name')
                ->label('Dibuat/diubah oleh')
                ->sortable()
                ->searchable()
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
                    ExportBulkAction::make()
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
            'index' => Pages\ListDaftarJenisPerawatans::route('/'),
            'create' => Pages\CreateDaftarJenisPerawatan::route('/create'),
            'edit' => Pages\EditDaftarJenisPerawatan::route('/{record}/edit'),
        ];
    }
}
