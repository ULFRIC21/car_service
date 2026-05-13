<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Part extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'stock_qty',
        'unit_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    public function workOrderLines(): HasMany
    {
        return $this->hasMany(WorkOrderLine::class);
    }
}
