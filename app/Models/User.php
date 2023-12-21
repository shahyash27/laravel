<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'profile_img'
    ];

    //protected $guarded = [];

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
        //'password' => 'hashed',
    ];

    protected function password(): Attribute 
    {
        return Attribute::make(
            set: fn (string $value) => bcrypt($value)
        );
    }

    protected function username(): Attribute 
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }

    /*protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }*/

    protected function isAdmin(): Attribute {
        $admins = ['shahyash279@yahoo.com','SHAHYASH279@YAHOO.COM'];

        return Attribute::make(
            get: fn() => in_array($this->email, $admins),
        );
    }

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}
