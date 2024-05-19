<?php

namespace App\Filament\Resources\SlabResource\Pages;

use App\Filament\Resources\SlabResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditSlab extends EditRecord
{
    protected static string $resource = SlabResource::class;

    public function publicMutateFormDataBeforeEdit(array $data): array
    {
        $beforeCreate = $this->mutateFormDataBeforeFill($data);
        $beforeSave   = $this->mutateFormDataBeforeSave($data);
        return [
            'beforeFill' => $beforeCreate,
            'beforeSave' => $beforeSave,
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
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
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

}
