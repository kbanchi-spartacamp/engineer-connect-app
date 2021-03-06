<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorSchedule extends Model
{
    use HasFactory;

    protected $dates = [
        'day',
        'start_time',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
