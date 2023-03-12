<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Language;
use App\Models\Organisation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements MessengerProvider, Searchable, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    use HasRoles; // Spatie Permissions

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'profile_photo_path',
        'city_id_1',
        'district_id_1',
        'about',
        'motivation',
        'date_of_birth',
        'website',
        'locale',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'email',
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
     * Get the user's profile.
     * One-to-one
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    /**
     * Get the user's organisation(s).
     * Many-to-many.
     */
    public function organisations()
    {
        return $this->belongsToMany(Organisation::class);
    }


    /**
     * Get all of the users's accounts.
     * One-to-many polymorphic.
     */
    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }

    /**
     * Get all of the languages of the user.
     * Many-to-many polymorphic.
     */
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languagable')->withPivot('competence');
    }

    /**
     * Get all of the media of the user.
     * Many-to-many polymorphic.
     */
    public function media()
    {
        return $this->morphToMany(Medium::class, 'mediable')->withPivot('id', 'user_on_medium', 'server_of_medium');
    }


    /**
     * Needed for Rtippin Messenger.
     * Implement the MessengerProvider interface for each provider registered.
     *
     * @return array
     */
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


    /**
     * Needed for Rtippin Messenger.
     * Searchable.
     *
     * @return void
     */
    public static function getProviderSearchableBuilder(
        Builder $query,
        string $search,
        array $searchItems
    ) {
        $query->where(function (Builder $query) use ($searchItems) {
            foreach ($searchItems as $item) {
                $query->orWhere('name', 'LIKE', "%{$item}%")
                ->orWhere('email', 'LIKE', "%{$item}%");
            }
        });
    }


    /**
     * Needed for Rtippin Messenger.
     * Messenger avator / profile photo location.
     *
     * @return string
     */
    public function getProviderAvatarColumn(): string
    {
        return 'profile_photo_path';
    }


    /**
     * Needed for Rtippin Messenger.
     * Get the route of the avatar for your provider. We will call this
     * from our resource classes using sm/md/lg.
     *
     * @param  string  $size
     * @return string|null
     */
    public function getProviderAvatarRoute(string $size = 'sm'): ?string
    {
        // dd($this);
        return '/storage/' . $this->profile_photo_path;
    }


    /**
     * Spatie Laravel-Searchable.
     *
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
        );
    }
}
