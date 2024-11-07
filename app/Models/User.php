<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'dob',
        'class',
        'address',
        'zip_code',
        'country_id',
        'state_id',
        'city_id',
        'profile_img'
        // 'parent_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    // public function image(): MorphMany
    // {
    //     return $this->morphMany(Media::class, 'mediaable');
    // }

    // public function getDisplayImageAttribute()
    // {
    //     return $this->profileImage('original');
    // }
    // protected function profileImage($type = 'original')
    // {
    //     $file = $this->image()->first()?->file;
    //     if ($file) {
    //         if (file_exists(public_path('storage/images/' . $type . '/profile/' . $file))) {
    //             return asset('storage/images/' . $type . '/profile/' . $file);
    //         }
    //         // }
    //     }
    //     return asset('assets/img/avatars/no-img.png');
    // }
}
