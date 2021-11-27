<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorSkill extends Model
{
    use HasFactory;

    public function skill_category()
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function mentor(){
        return $this->belongsTo(Mentor::class);
    }
}
