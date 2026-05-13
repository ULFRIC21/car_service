<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'body',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopePublicVisible(Builder $query): Builder
    {
        $now = now();

        return $query->where('is_active', true)
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }
}
