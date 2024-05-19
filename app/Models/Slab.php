<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slab extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'name',
            'brand',
            'description',
            'quantity',
            'supplier',
            'order_number',
            'price',
            //        'polishment',                         //Foi alterado para finish
            'thickness',
            'width',
            'length',
            'square_meters',
            'warehouse_position',
            'user_id',
            'image',
            'type_stone',
            'finishing',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setPriceAttribute($value)
    {
        // Transforma o valor para inteiro antes de salvar no banco de dados
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        // Formata o valor para duas casas decimais quando recuperado
        return $value / 100;
    }

    protected function casts(): array
    {
        return [
            'image' => 'array',
        ];
    }
}
