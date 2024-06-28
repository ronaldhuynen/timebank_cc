<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateCyclosAccountsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:cyclos_accounts';
    protected $description = 'Migrates all Cyclos accounts from the old Cyclos database to the new Laravel database';

    public function handle()
    {
        // Ask for database names
        //$sourceDb = $this->ask('Enter the name of the source database');
        // Or define database name
        $sourceDb = 'timebank_2024_06_11';
        $destinationDb = env('DB_DATABASE');



        

    }
}
