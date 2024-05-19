<?php

namespace App\Filament\Resources\SlabResource\Pages;

use App\Filament\Resources\SlabResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateSlab extends CreateRecord
{
    protected static string $resource = SlabResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $squareMeters = (($data['width'] / 1000) * ($data['length'] / 1000)) * $data['quantity'];
        $data['square_meters'] = round($squareMeters, 2);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        info('mutateFormDataBeforeSave is being called');

        $squareMeters = (($data['width'] / 1000) * ($data['length'] / 1000)) * $data['quantity'];
        $data['square_meters'] = round($squareMeters, 2);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [

        ];
    }


}
