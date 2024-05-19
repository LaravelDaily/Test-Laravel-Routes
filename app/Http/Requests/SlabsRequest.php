<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlabsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'brand' => ['required'],
            'description' => ['required'],
            'quantity' => ['required', 'integer'],
            'supplier' => ['required'],
            'order_number' => ['nullable'],
            'price' => ['nullable', 'numeric'],
            'polishment' => ['required'],
            'thickness' => ['required', 'integer'],
            'width' => ['required', 'numeric'],
            'length' => ['required', 'numeric'],
            'square_meters' => ['required', 'numeric'],
            'physical_position' => ['required'],
            'user_id' => ['required', 'integer'],
            'image' => ['nullable', 'string', 'max:8192'], //8MB
        ];
    }



    public function authorize(): bool
    {
        return true;
    }
}
