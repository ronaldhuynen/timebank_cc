<?php

namespace App\Models;

use App\Models\Locations\Location;
use App\Models\User;
use App\Notifications\VerifyProfileEmail;
use App\Traits\LocationTrait;
use App\Traits\TaggableWithLocale;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Scout\Searchable;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;

class Admin extends Model implements MessengerProvider, MustVerifyEmail, ReacterableInterface, ReactableInterface
{
    use HasFactory;
    use AuthMustVerifyEmail;
    use Notifiable;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    use TaggableWithLocale;
    use Reacterable; // cybercog/laravel-love
    use Reactable; // cybercog/laravel-love
    use Searchable; // laravel/scout with ElasticSearch
    use LocationTrait;


    /**
     * The attributes that should be hidden for serialization.
     * BEWARE: THE MESSENGER API CAN POTENTIALLY EXPOSE ALL VISIBLE FIELDS
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'email_verified_at',
        'full_name',
        'password',
        'remember_token',
        'phone',
        'cyclos_id',
        'cyclos_salt',
        'two_factor_confirmed_at',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'limit_min',
        'limit_max',
        'created_at',
        'updated_at',
        'last_login_at',
        'inactive_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'profile_photo_path',
        'last_login_at',
        'last_login_ip'
    ];


    /**
     * Get the admin's user(s) that can manage admin profiles.
     * Many-to-many.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the admin's related bank's.
     * Many-to-many.
     */
    public function banks()
    {
        return $this->belongsToMany(Bank::class);
    }


    /**
     * Get all related the locations of the admin.
     * One-to-many polymorph.
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'locatable');
    }


    /**
     * Rtippin Messenger:
     * Implement the MessengerProvider interface for each provider registered.
     *
     * @return array
     */
    public static function getProviderSettings(): array
    {
        return [
            'alias' => __('Admin'),
            'searchable' => false,
            'friendable' => false,
            'devices' => true,
            'default_avatar' => public_path('vendor/messenger/images/users.png'),
            'cant_message_first' => [],
            'cant_search' => [],
            'cant_friend' => [],
        ];
    }


    /**
     * Rtippin Messenger:
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
                ->orWhere('full_name', 'LIKE', "%{$item}%")
                ->orWhere('email', 'LIKE', "%{$item}%");
            }
        });
    }


    /**
     * Rtippin Messenger:
     * Messenger avator / profile photo location.
     *
     * @return string
     */
    public function getProviderAvatarColumn(): string
    {
        return 'profile_photo_path';
    }


    /**
     * Rtippin Messenger:
     * Get the route of the avatar for your provider. We will call this
     * from our resource classes using sm/md/lg.
     *
     * @param  string  $size
     * @return string|null
     */
    public function getProviderAvatarRoute(string $size = 'sm'): ?string
    {
        return '/storage/' . $this->profile_photo_path;
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyProfileEmail());
    }
}
