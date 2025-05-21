<?php

namespace App\Filament\Resources\GovermentResource\Pages;

use App\Filament\Resources\GovermentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGoverments extends ListRecords
{
    protected static string $resource = GovermentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
