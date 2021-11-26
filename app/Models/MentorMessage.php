<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MentorMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params['send_mentor_id']) && !empty($params['recieve_mentor_id'])) {
            $query
                ->where('send_mentor_id', $params['send_mentor_id'])
                ->where('recieve_mentor_id', $params['recieve_mentor_id']);
        }
    }

}
