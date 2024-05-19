<?php

use App\Filament\Resources\SlabResource\Pages\CreateSlab;

it('calculates square meters correctly', closure: function () {
    // Arrange
    $createSlab = new CreateSlab();
    $data = [
        'width' => 2000, // 2 meters
        'length' => 3000, // 3 meters
        'quantity' => 2,
        'price' => 100,
    ];

    // Act
    $result = $createSlab->publicMutateFormDataBeforeCreate($data);

    // Assert
    expect($result['square_meters'])->toEqual(12.0);
});
