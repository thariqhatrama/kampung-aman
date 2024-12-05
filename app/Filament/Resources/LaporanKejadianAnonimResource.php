<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use App\Models\LaporanKejadianAnonim;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanKejadianAnonimResource\Pages;
use App\Filament\Resources\LaporanKejadianAnonimResource\RelationManagers;

class LaporanKejadianAnonimResource extends Resource
{
    protected static ?string $model = LaporanKejadianAnonim::class;

    protected static ?string $navigationGroup = 'Laporan Kejadian';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam')
                    ->required(),
                Forms\Components\Textarea::make('lokasi_kejadian')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('jenis_kejadian_id')
                    ->relationship('jenisKejadian', 'nama')
                    ->required(),
                Forms\Components\Textarea::make('catatan_laporan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam'),
                Tables\Columns\TextColumn::make('jenisKejadian.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi_kejadian'),
                Tables\Columns\TextColumn::make('catatan_laporan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('tanggal')
                ->form([
                    DatePicker::make('tanggal_mulai'),
                    DatePicker::make('tanggal_selesai'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['tanggal_mulai'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                        )
                        ->when(
                            $data['tanggal_selesai'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail'),
                Action::make('map')
                    ->label('Lihat')
                    ->icon('heroicon-o-map-pin')
                    ->url(fn (LaporanKejadianAnonim $record) => LaporanKejadianAnonimResource::getUrl('map', ['record' => $record])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLaporanKejadianAnonims::route('/'),
            'map' => Pages\ViewMap::route('/{record}'),
        ];
    }
}
