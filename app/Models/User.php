<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Account;
use App\Models\Language;
use App\Models\Locations\Location;
use App\Models\Organization;
use App\Models\Post;
use App\Traits\TaggableWithLocale;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MessengerProvider, MustVerifyEmail, ReacterableInterface, ReactableInterface
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    use HasRoles; // Spatie Permissions
    use LogsActivity; // Spatie Activity Log
    use TaggableWithLocale;
    use Reacterable; // cybercog/laravel-love
    use Reactable; // cybercog/laravel-love
    use Searchable; // laravel/scout with ElasticSearch

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'profile_photo_path',
        'about',
        'motivation',
        'date_of_birth',
        'website',
        'phone',
        'password',
        'lang_preference',
        'last_login_at',
        'last_login_ip',
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
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'users_index';
    }

    /**
     * Convert this model to a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // Prepare eager loaded relationships
        $this->load('languages', 
                    'locations.district.locale', 
                    'locations.city.translations', 
                    'locations.division.locale', 
                    'locations.country.locale', 
                    'tags.contexts.tags', 
                    'tags.contexts.tags.locale',
                    'tags.contexts.category.ancestorsAndSelf',
                );

        return [
            'id' => $this->id,
            'name' => $this->name,
            'about' => $this->about,
            'motivation' => $this->motivation,
            'last_login_at' => $this->last_login_at,
            'lang_preference' => $this->lang_preference,

            'languages' => $this->languages->map(function ($language) { // map() as languages is a collection
                return [
                    'id' => $language->id,
                    'name' => $language->name,
                    'lang_code' => $language->lang_code,
                ];
            }),

            'locations' => $this->locations->map(function ($location) { // map() as locations is a collection
                return [
                    'id' => $location->id,
                    'district' => $location->district ? $location->district->locale->name : '',
                    'city' => $location->city ? $location->city->translations->map(function ($translation) {   // map() as translations is a collection
                        return $translation->name;
                    })->toArray() : [],
                    'division' => $location->division ? $location->division->locale->name : '',
                    'country' => $location->country ? $location->country->locale->name : '',
                ];
            }),

           'tags' => $this->tags->map(function ($tag) {
               return [                                
                   'contexts' => $tag->contexts
                        ->map(function ($context) {
                            return [
                                'tags' => $context->tags->map(function ($tag) {
                                    return [
                                        'name' => StringHelper::DutchTitleCase($tag->normalized),
                                        'locale' => $tag->locale->locale,
                                    ];
                                }),
                                'categories' => Category::with(['translations' => function ($query) { $query->select('category_id', 'locale', 'name');}])
                                    ->find([ $context->category->ancestorsAndSelf()->get()->flatMap(function ($related) {
                                        $categoryPath = explode('.', $related->path);
                                        return $categoryPath;
                                    })
                                    ->unique()->values()->toArray()
                                    ]),
                            ];
                        }),

                    ];
           })
        ];
    }


    /**
     * Get the user's profile.
     * One-to-one
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    /**
     * Get the user's organization(s).
     * Many-to-many.
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }


    /**
     * Get all related accounts of the user.
     * One-to-many polymorphic.
     */
    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }

    /**
     * Get all related languages of the user.
     * Many-to-many polymorphic.
     */
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languagable')->withPivot('competence');
    }

    /**
     * Get all related socials of the user.
     * Many-to-many polymorphic.
     */
    public function socials()
    {
        return $this->morphToMany(Social::class, 'sociable')->withPivot('id', 'user_on_social', 'server_of_social');
    }


    public function friends()
    {
        return $this->morphMany(Friend::class, 'owner');
    }


    public function pendingFriends()
    {
        return $this->morphMany(PendingFriend::class, 'sender');
    }


    /**
     * Get all related the locations of the user.
     * One-to-many polymorph.
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'locatable');
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
        return '/storage/' . $this->profile_photo_path;
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'email',
            'phone',
            'last_login_at',
            'last_login_ip',
            ])
        ->logOnlyDirty()   // Only log attributes that have been changed
        ->dontSubmitEmptyLogs()
        ->useLogName('user');
    }


    /**
     * Get all of the User's posts.
     */
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }


    /**
     * Get all of the User's posts.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
