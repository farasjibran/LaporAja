<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GovermentResource\Pages;
use App\Filament\Resources\GovermentResource\RelationManagers;
use App\Models\Goverments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GovermentResource extends Resource
{
    protected static ?string $model = Goverments::class;

    protected static ?string $navigationIcon = 'ri-government-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListGoverments::route('/'),
            'create' => Pages\CreateGoverment::route('/create'),
            'edit' => Pages\EditGoverment::route('/{record}/edit'),
        ];
    }
}
