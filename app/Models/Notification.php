<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'color',
        'subdesc',
        'desc',
        'notification',
        'status',
        'title',
        'icon',
        'user_id',
    ];
}
