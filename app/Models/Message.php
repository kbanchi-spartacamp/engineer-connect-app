<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params['mentor_id']) && !empty($params['user_id'])) {
            $query
                ->where('mentor_id', $params['mentor_id'])
                ->where('user_id', $params['user_id']);
        }
    }
}
