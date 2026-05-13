<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrderLine extends Model
{
    protected $fillable = [
        'work_order_id',
        'service_id',
        'part_id',
        'description',
        'quantity',
        'unit_price',
        'line_total',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }
}
