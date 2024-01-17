<?php

namespace App\Filament\Resources;

use DateTime;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Perawatan;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Pages\ViewDaftarPerawatan;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use App\Models\KendaraanSpesifikasi;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DaftarPerawatanResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\DaftarPerawatanResource\RelationManagers;

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
                            ->columnSpan(2)
                            ->hint('Masukkan tanggal permintaan')
                            ->default(now()),

                        Select::make('nopol')
                            ->searchable()
                            ->options(KendaraanSpesifikasi::all()->pluck('nopol', 'nopol'))
                            ->label('Plat Nomor')
                            ->required()
                            ->columnSpan(1),

                        Select::make('driver')
                            ->searchable()
                            ->options(KendaraanSpesifikasi::all()->pluck('driver', 'driver'))
                            ->label('Driver')
                            ->required()
                            ->columnSpan(1),

                        Select::make('perawatan_jenis_id')
                            ->relationship('perawatan_jenis', 'jenis')
                            ->label('Jenis Perawatan')
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('penanganan')
                            ->label('Keluhan')
                            ->placeholder('Masukkan keluhan / penanganan')
                            ->columnSpan(1),

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
                            ->date(),

                        DatePicker::make('tgl_selesai')
                            ->label('Tanggal Selesai')
                            ->date(),

                        TextInput::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Masukkan Keterangan'),

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

                        TextInput::make('bengkel')
                            ->label('Bengkel')
                            ->placeholder('Bengkel / beli di'),

                        TextInput::make('estimasi')
                            ->label('Estimasi')
                            ->placeholder('Estimasi harga sparepart/maintenance'),

                        Hidden::make('user_id')
                            ->default(Auth::user()->id),

                        Select::make('perawatan_status_id')
                            ->relationship('perawatan_status', 'nama')
                            ->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([50, 100, 'all'])
            ->columns([
                TextColumn::make('tgl')
                    ->label('TANGGAL')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nopol')
                    ->label('NOPOL')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('driver')
                    ->label('DRIVER')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('penanganan')
                    ->label('PENANGANAN')
                    ->sortable()
                    ->wrap()
                    ->searchable(),

                TextColumn::make('kilometer')
                    ->label('KILOMETER')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kilometer_cek_ulang')
                    ->label('Cek KM sebelum')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tgl_cek_ulang')
                    ->label('Cek Sebelum Tgl')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tgl_selesai')
                    ->label('TANGGAL SELESAI')
                    ->date('d M Y')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('foto_nota'),

                ImageColumn::make('foto_sparepart'),

                TextColumn::make('bengkel')
                    ->label('BENGKEL / BELI DI')
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('keterangan')
                    ->label('KETERANGAN')
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('perawatan_status.nama')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Diajukan' => 'gray',
                        'Sedang dikerjakan' => 'info',
                        'Dibatalkan' => 'primary',
                        'Kumat' => 'danger',
                    })
                    ->sortable()
                    ->searchable()
                    ->label('STATUS'),

            ])
            ->filters([
                Filter::make('tgl_selesai')
                    ->label('Tanggal Selesai'),
                Filter::make('penanganan')
                    ->label('Penanganan'),
                Filter::make('perawatan_status.nama')
                    ->label('Status'),
                Filter::make('keterangan')
                    ->label('Keterangan'),
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
                // Tables\Actions\EditAction::make(),
                // DeleteAction::make(),
                ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),

                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('tgl')
                    ->label('Tanggal')
                    ->date('d M y')
                    ->columnSpanFull(),

                TextEntry::make('nopol')
                    ->label('Nopol'),

                TextEntry::make('driver')
                    ->label('Driver'),

                TextEntry::make('penanganan')
                    ->label('Keluhan')
                    ->limit(150)
                    ->columnSpanFull(),

                TextEntry::make('kilometer_cek_ulang')
                    ->label('Cek KM Sebelum'),

                TextEntry::make('tgl_cek_ulang')
                    ->label('Cek TANGGAL Sebelum')
                    ->date('d M y'),

                ImageEntry::make('foto_nota'),
                ImageEntry::make('foto_sparepart'),

                TextEntry::make('bengkel')
                    ->label('Bengkel'),

                TextEntry::make('keterangan')
                    ->label('Keterangan'),

                TextEntry::make('perawatan_status.nama')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Diajukan' => 'gray',
                        'Sedang dikerjakan' => 'info',
                        'Dibatalkan' => 'primary',
                        'Kumat' => 'danger',
                    })



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
            // 'view' => Pages\ViewDaftarPerawatan::route('/{record}'),
            'edit' => Pages\EditDaftarPerawatan::route('/{record}/edit'),
        ];
    }
}
