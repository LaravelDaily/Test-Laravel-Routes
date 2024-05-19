<?php

namespace App\Filament\Resources\SlabResource\Pages;

use App\Filament\Resources\SlabResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSlab extends ListRecords
{
    protected static string $resource = SlabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
