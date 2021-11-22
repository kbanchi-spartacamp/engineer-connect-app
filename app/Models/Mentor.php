<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Mentor extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function mentor_skills()
    {
        return $this->hasMany(MentorSkill::class);
    }

    public function mentor_schedules()
    {
        return $this->hasMany(MentorSchedule::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function my_schedules($day, $day_of_week)
    {
        $query = MentorSchedule::query();
        $param = [
            'id' => $this->id,
            'day' => $day,
            'day_of_week' => $day_of_week
        ];

        $query->where(function ($query) use ($param) {
            $query->where('mentor_id', $param['id']);
        });

        $query->where(function ($query) use ($param) {
            $query->where('day', $param['day'])
                ->orWhere('day_of_week', $param['day_of_week']);
        });
        $query->orderBy('start_time');
        $schedules = $query->get();
        return $schedules;
    }

    public function my_review()
    {
        $query = Review::query();
        $param = [
            'id' => $this->id
        ];

        $query->where(function ($query) use ($param) {
            $query->where('mentor_id', $param['id']);
        });

        $reviews = $query->get();

        $total = 0;
        foreach ($reviews as $review) {
            $total = $total + $review->star;
        }

        if ($reviews->count() == 0) {
            return 0;
        }

        return round($total / $reviews->count());
    }
}
