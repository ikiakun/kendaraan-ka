<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarStatusPerawatanResource\Pages;
use App\Filament\Resources\DaftarStatusPerawatanResource\RelationManagers;
use App\Models\PerawatanStatus;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DaftarStatusPerawatanResource extends Resource
{
    protected static ?string $model = PerawatanStatus::class;
    protected static ?string $navigationGroup = 'Perawatan';
    protected static ?string $navigationLabel = 'Status Perawatan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Status')
                    ->required()
                    ->unique(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                ->label('Status')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDaftarStatusPerawatans::route('/'),
            'create' => Pages\CreateDaftarStatusPerawatan::route('/create'),
            'edit' => Pages\EditDaftarStatusPerawatan::route('/{record}/edit'),
        ];
    }
}
