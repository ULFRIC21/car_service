<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'service_id',
        'status',
        'description',
        'total_price',
        'scheduled_at',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'Ожидает',
            'confirmed' => 'Подтверждён',
            'in_progress' => 'В работе',
            'completed' => 'Завершён',
            'cancelled' => 'Отменён',
        ][$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'confirmed' => 'info',
            'in_progress' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}
