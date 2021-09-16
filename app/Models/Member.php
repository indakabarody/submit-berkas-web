<?php

namespace App\Models;

use App\Notifications\CustomResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'province_id',
        'google_id',
        'facebook_id',
        'name',
        'image',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'institution',
        'address',
        'is_book_publisher',
        'is_training_organizer',
        'is_active_participant',
        'is_activated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token, 'member'));
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function announcement()
    {
        return $this->hasMany(Announcement::class, 'member_id');
    }
}
