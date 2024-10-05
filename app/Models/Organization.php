<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Language;
use App\Models\Locations\Location;
use App\Models\Post;
use App\Models\User;
use App\Traits\TaggableWithLocale;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableInterface;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableInterface;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Scout\Searchable;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;

class Organization extends Model implements MessengerProvider, ReacterableInterface, ReactableInterface
{
    use HasFactory;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    use TaggableWithLocale;
    use Reacterable; // cybercog/laravel-love
    use Reactable; // cybercog/laravel-love
    use Searchable; // laravel/scout with ElasticSearch


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
        'name',
        'email',
        'profile_photo_path',
        'about',
        'motivation',
        'website',
        'phone',
        'last_login_at',
        'last_login_ip'
    ];


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'organizations_index';
    }


    /**
    * Convert this model to a searchable array.
    *
    * @return array
    */
    public function toSearchableArray()
    {
        // Prepare eager loaded relationships
        $this->load(
            'languages',
            'locations.district.translations',
            'locations.city.translations',
            'locations.division.translations',
            'locations.country.translations',
            'tags.contexts.tags',
            'tags.contexts.tags.locale',
            'tags.contexts.category.ancestorsAndSelf',
        );

        return [

            'id' => $this->id,
            'name' => $this->name,

            //TODO: Update to multilang database structure in future
            'about_nl' => $this->about,
            'about_en' => $this->about,
            'about_fr' => $this->about,
            'about_de' => $this->about,
            'about_es' => $this->about,
            'about_short_nl' => $this->about_short,
            'about_short_en' => $this->about_short,
            'about_short_fr' => $this->about_short,
            'about_short_de' => $this->about_short,
            'about_short_es' => $this->about_short,
            'motivation_nl' => $this->motivation,
            'motivation_en' => $this->motivation,
            'motivation_fr' => $this->motivation,
            'motivation_de' => $this->motivation,
            'motivation_es' => $this->motivation,

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
                    'district' => $location->district ? $location->district->translations->map(function ($translation) {   // map() as translations is a collection
                        return $translation->name;
                    })->toArray() : [],
                    'city' => $location->city ? $location->city->translations->map(function ($translation) {   // map() as translations is a collection
                        return $translation->name;
                    })->toArray() : [],
                    'division' => $location->division ? $location->division->translations->map(function ($translation) {   // map() as translations is a collection
                        return $translation->name;
                    })->toArray() : [],
                    'country' => $location->country ? $location->country->translations->map(function ($translation) {   // map() as translations is a collection
                        return $translation->name;
                    })->toArray() : [],
                ];
            }),

            'tags' => $this->tags->map(function ($tag) {
                return [
                    'contexts' => $tag->contexts
                        ->map(function ($context) {
                            return [
                                'tags' => $context->tags->map(function ($tag) {
                                    // Include the locale in the field name for tags
                                    return [
                                        'name_' . $tag->locale->locale => StringHelper::DutchTitleCase($tag->normalized),
                                    ];
                                }),
                                'categories' => Category::with(['translations' => function ($query) { $query->select('category_id', 'locale', 'name');}])
                                    ->find([ $context->category->ancestorsAndSelf()->get()->flatMap(function ($related) {
                                        $categoryPath = explode('.', $related->path);
                                        return $categoryPath;
                                    })
                                    ->unique()->values()->toArray()
                                    ])->map(function ($category) {
                                        // Include the locale in the field name for categories
                                        return $category->translations->mapWithKeys(function ($translation) {
                                            return ['name_' . $translation->locale => StringHelper::DutchTitleCase($translation->name)];
                                        });
                                    }),
                            ];
                        }),
                ];
            })
        ];
    }


    /**
     * Get the organization's profile.
     * One-to-one
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    /**
     * Get all of the organization's accounts.
     * One-to-many polymorphic.
     *
     * @return void
     */
    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }


    /**
     * Check if the organization has any associated accounts.
     *
     * @return bool Returns true if the user has accounts, false otherwise.
     */
    public function hasAccounts()
    {        
        $accountsExists = DB::table('accounts')
                            ->where('accountable_id', $this->id)
                            ->where('accountable_type', 'App\Models\User')
                            ->exists();
        return $accountsExists;
    }



    /**
     * Get the organization's user(s).
     * Many-to-many.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the languages for the organization.
     * Many-to-many polymorphic.
     */
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languagable')->withPivot('competence');
    }


    /**
     * Get all of the social for the organization.
     * Many-to-many polymorphic.
     */
    public function socials()
    {
        return $this->morphToMany(Social::class, 'sociable')->withPivot('id', 'user_on_social', 'server_of_social');
    }


    /**
     * Get all related the locations of the organization.
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
            'alias' => 'organization',
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


    /**
     * Get all of the Organization's posts.
     */
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }


    /**
     * Get all of the Organization's posts.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
