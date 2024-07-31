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

class Bank extends Model implements MessengerProvider, ReacterableInterface, ReactableInterface
{
    use HasFactory;
    use HasProfilePhoto;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface
    use TaggableWithLocale;
    use Reacterable; // cybercog/laravel-love
    use Reactable; // cybercog/laravel-love
    use Searchable; // laravel/scout with ElasticSearch



    /**
     * Get the bank's user(s) that can manage bank profiles.
     * Many-to-many.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * Get all related the locations of the bank.
     * One-to-many polymorph.
     */
    public function locations()
    {
        return $this->morphMany(Location::class, 'locatable');
    }


    
    /**
     * Check if the bank has any associated accounts.
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
     * Rtippin Messenger:
     * Implement the MessengerProvider interface for each provider registered.
     *
     * @return array
     */
    public static function getProviderSettings(): array
    {
        return [
            'alias' => 'timebank',
            'searchable' => true,
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
    
}
