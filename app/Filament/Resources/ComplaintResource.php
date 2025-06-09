<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Models\Complaints;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaints::class;

    protected static ?string $navigationIcon = 'hugeicons-complaint';

    public static function canCreate(): bool
    {
        return false;
    }

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
                TextColumn::make('title_complaint')->label('Title'),
                TextColumn::make('unique_code')->label('Nomor Laporan'),
                TextColumn::make('status')->badge()
                    ->colors([
                        'info' => 'open',
                        'warning' => 'in_progress',
                        'success' => 'closed',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'open' => __('Open'),
                        'in_progress' => __('In Progress'),
                        'closed' => __('Closed'),
                        'rejected' => __('Rejected'),
                        default => $state,
                    }),
                TextColumn::make('created_at')->dateTime('d-m-Y')->label('Created At'),
            ])
            ->searchable()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('handle')
                    ->label('View & Handle')
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn(Model $record): string => static::getUrl('handle', ['record' => $record->getKey()])),
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
            'index' => Pages\ListComplaints::route('/'),
            'handle' => Pages\HandleComplaint::route('/{record}/handle'),
        ];
    }
}
