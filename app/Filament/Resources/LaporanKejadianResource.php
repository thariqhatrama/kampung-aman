<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanKejadianResource\Pages;
use App\Filament\Resources\LaporanKejadianResource\RelationManagers;
use App\Models\LaporanKejadian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporanKejadianResource extends Resource
{
    protected static ?string $model = LaporanKejadian::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam')
                    ->required(),
                Forms\Components\TextInput::make('nama_pelapor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_tlp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('lokasi_kejadian')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('lat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('long')
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
                Tables\Columns\TextColumn::make('nama_pelapor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_tlp')
                    ->label('No. Telp')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('lat')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('long')
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
            'index' => Pages\ListLaporanKejadians::route('/'),
            'create' => Pages\CreateLaporanKejadian::route('/create'),
            'edit' => Pages\EditLaporanKejadian::route('/{record}/edit'),
        ];
    }
}
