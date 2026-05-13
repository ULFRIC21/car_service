<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallbackRequest extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_DONE = 'done';

    protected $fillable = [
        'name',
        'phone',
        'message',
        'status',
    ];
}
