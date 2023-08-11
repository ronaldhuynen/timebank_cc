<?php

namespace App\Models;

use App\Models\Language;
use App\Models\Locations\Location;
use App\Models\Post;
use App\Models\User;
use App\Traits\TaggableWithLocale;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Organization extends Model implements MessengerProvider, Searchable
{
    use HasFactory;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    // use Taggable; // Cviebrock Eloquent Taggable
    use TaggableWithLocale;



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'password',
    ];


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
     * Nessenger avator / profile photo location.
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

    /**
     * Get all of the Organization's posts.
     */
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    /**
     * Get all related the locations of the user.
     * Many-to-many polymorphic.
     */
    public function locations()
    {
        return $this->morphToMany(Location::class, 'locationable');
    }

}
