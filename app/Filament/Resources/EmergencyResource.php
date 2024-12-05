<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Emergency;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmergencyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmergencyResource\RelationManagers;

class EmergencyResource extends Resource
{
    protected static ?string $model = Emergency::class;

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Laporan Kejadian';
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam')
                    ->required(),
                // Forms\Components\TextInput::make('nama_pelapor')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('no_tlp')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\Textarea::make('lokasi_kejadian')
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pelapor')
                    ->searchable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.no_tlp')
                    ->label('No. Telp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi_kejadian')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('latitude')
                //     ->searchable(),
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
                    ->url(fn (Emergency $record) => EmergencyResource::getUrl('map', ['record' => $record])),
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
            'index' => Pages\ManageEmergencies::route('/'),
            'map' => Pages\ViewMap::route('/{record}'),
        ];
    }
}
