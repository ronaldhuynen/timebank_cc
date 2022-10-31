<?php

namespace App\Models;

use App\Models\Account;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Query\Builder;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use RTippin\Messenger\Traits\Messageable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use RTippin\Messenger\Contracts\MessengerProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MessengerProvider
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
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

    // Get the user's profile
    // One-to-one
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    // Get all of the users's accounts
    // One-to-many polymorphic
    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }


    // Rtippin Messenger:
    // Implement the MessengerProvider interface for each provider registered
    public static function getProviderSettings(): array
    {
        return [
            'alias' => 'user',
            'searchable' => true,
            'friendable' => true,
            'devices' => true,
            'default_avatar' => public_path('vendor/messenger/images/users.png'),
            'cant_message_first' => [],
            'cant_search' => [],
            'cant_friend' => [],
        ];
    }


    // Rtippin Messenger:
    // Searchable
    public static function getProviderSearchableBuilder(Builder $query,
                                                        string $search,
                                                        array $searchItems)
    {
        $query->where(function (Builder $query) use ($searchItems) {
            foreach ($searchItems as $item) {
                $query->orWhere('first_name', 'LIKE', "%{$item}%")
                ->orWhere('last_name', 'LIKE', "%{$item}%");
            }
        })->orWhere('email', '=', $search);
    }


    // Rtippin Messenger:
    // messenger avator / profile photo location
    public function getProviderAvatarColumn(): string
    {
        return 'profile_photo_path';
    }
}
