<?php

namespace App;

use App\Models\Trip;
use App\Models\Booking;
use App\Models\Vehicle;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\{
    HasMediaTrait,
    Interfaces\HasMedia
};
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    const PASSENGER_PERMISSION = 1;
    const DRIVER_PERMISSION = 2;
    const ADMIN_PERMISSION = 4;

    const MEDIA_AVATARS_COLLECTION = 'avatars';

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->verification_token = str_random(30);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'permissions',
        'phone',
        'birth_date',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'birth_date',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return (bool) ($this->attributes['permissions'] & self::ADMIN_PERMISSION);
    }

    /**
     * @return bool
     */
    public function isPassenger(): bool
    {
        return (bool) ($this->attributes['permissions'] & self::PASSENGER_PERMISSION);
    }

    /**
     * @return bool
     */
    public function isDriver(): bool
    {
        return (bool) ($this->attributes['permissions'] & self::DRIVER_PERMISSION);
    }

    /**
     * @param int $role
     * @return bool
     */
    public function hasRole(int $role): bool
    {
        return (bool) ($this->attributes['permissions'] & $role);
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return (bool) ($this->attributes['is_verified']);
    }

    /**
     * Check whether the passenger has at least one booking.
     *
     * @return bool
     */
    public function hasBooking(): bool
    {
        return $this->bookings()->first() !== null;
    }

    /**
     * Check whether the driver has at least one trip.
     *
     * @return bool
     */
    public function hasTrip(): bool
    {
        return $this->trips()->first() !== null;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user avatar media instance.
     *
     * @return \Spatie\MediaLibrary\Media|null
     */
    public function getAvatar(): ?Media
    {
        return $this->getFirstMedia(self::MEDIA_AVATARS_COLLECTION);
    }

    /**
     * Get the full url of the user avatar.
     *
     * @param  bool $fullUrl
     * @return string|null
     */
    public function getAvatarUrl(bool $fullUrl = false): ?string
    {
        $avatar = $this->getAvatar();

        if ($avatar === null) {
            return null;
        }
        if ($fullUrl) {
            return $this->getAvatar()->getFullUrl();
        }
        return $this->getAvatar()->getUrl();
    }

    /**
     * Delete the user avatar.
     *
     * @return $this
     */
    public function deleteAvatar(): self
    {
        return $this->clearMediaCollection(self::MEDIA_AVATARS_COLLECTION);
    }
}
