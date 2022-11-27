<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Traits\Messageable;

class Organisation extends Model implements MessengerProvider
{
    use HasFactory;
    use Messageable; // RTippin Messenger: Default trait to satisfy MessengerProvider interface



    // Get all of the organisation's accounts
    // One-to-many polymorphic
    public function accounts()
    {
        return $this->morphMany(Account::class, 'accountable');
    }

    // Get the organisation's user(s)
    // Many-to-many
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    // Rtippin Messenger:
    // Implement the MessengerProvider interface for each provider registered
    public static function getProviderSettings(): array
    {
        return [
            'alias' => 'organisation',
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
    public static function getProviderSearchableBuilder(
        Builder $query,
        string $search,
        array $searchItems
    )
    {
        $query->where(function (Builder $query) use ($searchItems) {
            foreach ($searchItems as $item) {
                $query->orWhere('name', 'LIKE', "%{$item}%")
                ->orWhere('email', 'LIKE', "%{$item}%");
            }
        });
    }


    // Rtippin Messenger:
    // messenger avator / profile photo location
    public function getProviderAvatarColumn(): string
    {
        return 'profile_photo_path';
    }

        // Rtippin Messenger:
    /**
     * Get the route of the avatar for your provider. We will call this
     * from our resource classes using sm/md/lg .
     *
     * @param  string  $size
     * @return string|null
     */
    public function getProviderAvatarRoute(string $size = 'sm'): ?string
    {
        // dd($this);
        return '/storage/' . $this->profile_photo_path;
    }
}
