<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $dates = [
        'day',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
