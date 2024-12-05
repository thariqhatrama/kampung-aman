<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kelurahan;
use Filament\Tables\Table;
use App\Models\StatusDaerah;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StatusDaerahResource\Pages;
use App\Filament\Resources\StatusDaerahResource\RelationManagers;

class StatusDaerahResource extends Resource
{
    protected static ?string $model = StatusDaerah::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Laporan Kejadian';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelurahan_id')
                    ->relationship('kelurahan', 'nama')
                    ->createOptionForm(Kelurahan::getForm())
                    ->columnSpanFull()
                    ->required(),
                // Forms\Components\TextInput::make('jumlah_laporan')
                //     ->required()
                //     ->numeric(),
                Forms\Components\Repeater::make('jenis_kejadian')
                    ->columnSpanFull()
                    ->relationship('kejadianStatusDaerah')
                    ->columns(2)
                    ->nullable()
                    ->schema([
                        Forms\Components\Select::make('jenis_kejadian_id')
                            ->relationship('jenisKejadian', 'nama'),
                        Forms\Components\TextInput::make('jumlah')
                            ->numeric(),
                    ])
                    ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kelurahan.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_laporan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kejadianStatusDaerah.jenisKejadian.nama')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kejadianStatusDaerah.jumlah')
                    ->label('Jumlah')
                    ->prefix('x ')
                    ->listWithLineBreaks()
                    ->sortable(),
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
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->after(function ($record) {
                            $jumlahLaporan = $record->kejadianStatusDaerah->sum('jumlah');
                            $record->update([
                                'jumlah_laporan' => $jumlahLaporan,
                            ]);
                        }),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->button()
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
            'index' => Pages\ManageStatusDaerahs::route('/'),
            'view' => Pages\ViewMap::route('/{record}'),
        ];
    }
}
