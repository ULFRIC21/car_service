<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'appointment_id',
        'mechanic_id',
        'status',
        'total_amount',
        'client_visible_notes',
        'internal_notes',
        'opened_at',
        'completed_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'opened_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function mechanic(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(WorkOrderLine::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function recalculateTotal(): void
    {
        $this->forceFill([
            'total_amount' => $this->lines()->sum('line_total'),
        ])->save();
    }

    public function isEditableByAdmin(): bool
    {
        return ! in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_CANCELLED], true);
    }
}
