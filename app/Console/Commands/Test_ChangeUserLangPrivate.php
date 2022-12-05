<?php

namespace App\Console\Commands;

use App\Events\Test_UserLangChangedEventPrivate;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class Test_ChangeUserLangPrivate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:lang-private';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user language and broadcast private event';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = 2;
        $user = User::find($userId);

        $lang = [
            'nl',
            'en',
            'fr',
            'es',
            'de',
            'it',
        ];
        $user->update([
            'locale' => Arr::random($lang),
        ]);

        Test_UserLangChangedEventPrivate::dispatch($user);

        return 0;
    }
}
