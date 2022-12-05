<?php

namespace App\Console\Commands;

use App\Events\Test_UserLangChangedEvent;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class Test_ChangeUserLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:lang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user language with a public channel';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(2);

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

        Test_UserLangChangedEvent::dispatch($user);

         return 0;
    }
}
