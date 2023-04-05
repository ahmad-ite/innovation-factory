<?php

namespace App\Models;

use App\Events\UserSaved;
use App\Traits\UrlHelper;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes,HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable,UrlHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',

        'email',
        'password',
        'photo',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * Retrieve the default photo from storage.
     * Supply a base64 png image if the `photo` column is null.
     */
    public function getAvatarAttribute(): string
    {
        return $this->photo ? $this->url($this->photo) : $this->url(config('default.avatar'));
    }

    /**
     * Retrieve the user's full name in the format:
     *  [firstname][ mi?][ lastname]
     * Where:
     *  [ mi?] is the optional middle initial.
     */
    public function getFullnameAttribute(): string
    {
        return $this->middlename ? $this->firstname.' '.$this->middlename.' '.$this->lastname
            : $this->firstname.' '.$this->lastname;
    }

    /**
     * Retrieve the user's Middleinitial from middlename
     * E.g. "delos Santos" -> "D."
     */
    public function getMiddleinitialAttribute(): string
    {
        return $this->middlename ? ucfirst($this->middlename[0]).'.'
        : '';
    }

    /**
     * hash password before saving
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->id ? $value : Hash::make($value),
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class, 'user_id', 'id');
    }

    public function save(array $options = [])
    {
        parent::save($options);

        event(new UserSaved($this));
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::observe(UserObserver::class);
    // }
}
