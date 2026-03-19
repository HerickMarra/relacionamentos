<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoveLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'words_of_affirmation',
        'acts_of_service',
        'receiving_gifts',
        'quality_time',
        'physical_touch',
        'analysis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
