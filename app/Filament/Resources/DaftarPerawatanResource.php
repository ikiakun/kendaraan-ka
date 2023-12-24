<?php

namespace App\Filament\Resources;

use DateTime;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Perawatan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Field;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DaftarPerawatanResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DaftarPerawatanResource\RelationManagers;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Infolists\Components\Grid as ComponentsGrid;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;

class DaftarPerawatanResource extends Resource
{
    protected static ?string $model = Perawatan::class;
    protected static ?string $navigationLabel = 'Daftar Perawatan';
    protected static ?string $navigationGroup = 'Perawatan';


    // protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        DatePicker::make('tgl')
                            ->label('Tanggal')
                            ->required()
                            ->hint('Masukkan tanggal permintaan'),

                        Select::make('kendaraan_spesifikasi_id')
                            ->relationship('kendaraan_spesifikasi', 'plat_nomor')
                            ->label('Plat Nomor')
                            ->required()
                            ->columnSpan(2),

                        Select::make('perawatan_jenis_id')
                            ->relationship('perawatan_jenis', 'jenis')
                            ->label('Jenis Perawatan')
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('penanganan')
                            ->label('Penanganan')
                            ->hint('Masukkan Penanganan')
                            ->hintColor('warning')
                            ->columnSpan(2),

                        TextInput::make('kilometer')
                            ->label('Kilometer')
                            ->numeric()
                            ->hint('Masukkan kilometer setelah servis')
                            ->hintColor('warning')
                            ->columnSpan(1),

                        TextInput::make('kilometer_cek_ulang')
                            ->label('Cek sebelum km')
                            ->hint('Masukkan estimasi kilometer cek ulang kedepan')
                            ->hintColor('warning')
                            ->numeric()
                            ->columnSpan(1),

                        DatePicker::make('tgl_cek_ulang')
                            ->label('Cek sebelum tgl')
                            ->hint('Masukkan estimasi tanggal cek ulang kedepan')
                            ->hintColor('warning')
                            ->date()
                            ->columnSpan(2),

                        FileUpload::make('foto_nota')
                            ->label('Foto Nota')
                            ->hint('bila ada')
                            ->image()
                            ->directory('img/nota')
                            ->preserveFilenames(),

                        FileUpload::make('foto_sparepart')
                            ->label('Foto Sparepart')
                            ->hint('bila ada')
                            ->image()
                            ->directory('img/sparepart'),

                        TextInput::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Masukkan Keterangan'),

                        Hidden::make('user_id')
                            ->default(Auth::user()->id),

                        Hidden::make('perawatan_status_id')
                            ->default(1),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tgl')
                    ->label('Tanggal')
                    ->date('d-M-Y')
                    // ->jalaliDate()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kendaraan_spesifikasi.plat_nomor')
                    ->label('Nopol')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kendaraan_spesifikasi.driver')
                    ->label('Driver')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('penanganan')
                    ->label('Penanganan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kilometer')
                    ->label('Kilometer Baru')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kilometer_cek_ulang')
                    ->label('Cek KM sebelum')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tgl_cek_ulang')
                    ->label('Cek Sebelum Tgl')
                    ->date()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tgl_selesai')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('foto_nota'),

                ImageColumn::make('foto_sparepart'),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('perawatan_status.nama')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),


            ])
            ->filters([
                Filter::make('tgl')
                    ->label('Tanggal Masuk')
                    ->form([
                        DatePicker::make('Dari Tanggal'),
                        DatePicker::make('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['Dari Tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tgl', '>=', $date),
                            )
                            ->when(
                                $data['Sampai Tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tgl', '<=', $date),
                            );
                    }),

                // Filter::make('tgl_selesai')
                //     ->form([
                //         DatePicker::make('Dari Tanggal'),
                //         DatePicker::make('Sampai Tanggal'),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                //             ->when(
                //                 $data['Dari Tanggal'],
                //                 fn (Builder $query, $date): Builder => $query->whereDate('tgl_selesai', '>=', $date),
                //             )
                //             ->when(
                //                 $data['Sampai Tanggal'],
                //                 fn (Builder $query, $date): Builder => $query->whereDate('tgl_selesai', '<=', $date),
                //             );
                //     }),
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
            'index' => Pages\ListDaftarPerawatans::route('/'),
            'create' => Pages\CreateDaftarPerawatan::route('/create'),
            'edit' => Pages\EditDaftarPerawatan::route('/{record}/edit'),
        ];
    }
}
