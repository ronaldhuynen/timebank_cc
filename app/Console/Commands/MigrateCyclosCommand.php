<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MigrateCyclosCommand extends Command
{
    protected $signature = 'migrate:cyclos';
    protected $description = 'Migrates all Cyclos users from the old Cyclos database to the new Laravel database';

    public function handle()
    {
        // Ask for database names
        //$sourceDb = $this->ask('Enter the name of the source database');
        // Or define database name
        $sourceDb = 'timebank_2024_06_11';
        $destinationDb = env('DB_DATABASE');

        $userLimitMin = config('timebank-cc.accounts.user.limit_min');
        $userLimitMax = config('timebank-cc.accounts.user.limit_max');
        $orgLimitMin = config('timebank-cc.accounts.organization.limit_min');
        $orgLimitMax = config('timebank-cc.accounts.organization.limit_max');
        $bankLimitMin = config('timebank-cc.accounts.bank.limit_min');
        $bankLimitMax = config('timebank-cc.accounts.bank.limit_max');


        // MIGRATE MEMBERS

        // Active Users (group_id 5)
        DB::beginTransaction();
        try {
            $activeUsers = DB::affectingStatement("
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, email_verified_at, created_at, updated_at, name, cyclos_salt, password, limit_min, limit_max, last_login_at)
                SELECT 
                    m.id AS cyclos_id, 
                    m.name AS full_name, 
                    m.email AS email,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                    NOW() AS updated_at,
                    u.username AS name, 
                    u.salt AS cyclos_salt, 
                    u.password AS password,
                    " . $userLimitMin . " as limit_min,
                    " . $userLimitMax . " as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 5
                ON DUPLICATE KEY UPDATE 
                    full_name = VALUES(full_name),      
                    email = VALUES(email), 
                    created_at = VALUES(created_at), 
                    updated_at = NOW(),
                    name = VALUES(name), 
                    cyclos_salt = VALUES(cyclos_salt), 
                    password = VALUES(password), 
                    last_login_at = VALUES(last_login_at);
                        ");
            DB::commit();
            $this->info("Users: $activeUsers");
            $this->info("Users migration completed successfully");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Users migration failed: ' . $e->getMessage());
        }




        // Inactive Users (group_id 6)
        DB::beginTransaction();
        try {
            $inActiveUsers = DB::affectingStatement("
                                    
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, email_verified_at, created_at, updated_at, name, cyclos_salt, password, limit_min, limit_max, last_login_at, inactive_at)
                SELECT 
                    m.id AS cyclos_id, 
                    m.name AS full_name, 
                    m.email AS email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                    NOW() AS updated_at,
                    u.username AS name, 
                    u.salt AS cyclos_salt, 
                    u.password AS password, 
                    " . $userLimitMin . " as limit_min,
                    " . $userLimitMax . " as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(ghl.start_date)) AS inactive_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                LEFT JOIN `{$sourceDb}`.`group_history_logs` ghl ON m.id = ghl.element_id
                WHERE ghl.group_id = 6 AND ghl.end_date IS NULL AND m.group_id = 6
                ");
            DB::commit();
            $this->info("Inactive Users: $inActiveUsers");
            $this->info("Inactive Users migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Inactive Users migration failed: ' . $e->getMessage());
        }




        //Removed Users (cyclos group_id 8):
        DB::beginTransaction();

        try {
            $removedUsers = DB::affectingStatement("
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, email_verified_at, created_at, updated_at, name, cyclos_salt, password, limit_min, limit_max, last_login_at, deleted_at)
                SELECT 
                    m.id AS cyclos_id, 
                    CONCAT('Removed user ',  m.id) AS full_name,
                    CONCAT(m.id, '@removed.mail') AS email,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                    NOW() AS updated_at,
                    CONCAT('Removed user ', m.id) AS name,
                    u.salt AS cyclos_salt, 
                    u.password AS password,
                    0 as limit_min,
                    0 as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(ghl.start_date)) AS deleted_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                LEFT JOIN `{$sourceDb}`.`group_history_logs` ghl ON m.id = ghl.element_id
                WHERE ghl.group_id = 8 AND ghl.end_date IS NULL AND m.group_id = 8
                ON DUPLICATE KEY UPDATE 
                    full_name = VALUES(full_name), 
                    email = VALUES(email), 
                    created_at = VALUES(created_at), 
                    updated_at = NOW(),
                    name = VALUES(name), 
                    cyclos_salt = VALUES(cyclos_salt), 
                    password = VALUES(password), 
                    last_login_at = VALUES(last_login_at),
                    deleted_at = VALUES(deleted_at);
                ");
            DB::commit();
            $this->info("Removed Users: $removedUsers");
            $this->info("Removed Users migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Removed Users migration failed: ' . $e->getMessage());
        }




        //Local Bank (Level I) (Cyclos group_id 13)
        DB::beginTransaction();
        try {
            $localBanks = DB::affectingStatement("
                INSERT INTO {$destinationDb}.banks (cyclos_id, name, full_name, email, email_verified_at, cyclos_salt, password, limit_min, limit_max, created_at, updated_at, last_login_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name,
                    m.name as full_name,
                    m.email as email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    u.salt AS cyclos_salt, 
                    u.password AS password, 
                    " . $bankLimitMin . " as limit_min,
                    " . $bankLimitMax . " as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                    NOW() AS updated_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 13
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    name = VALUES(full_name),
                    email = VALUES(email), 
                    email_verified_at = VALUES(email_verified_at),
                    created_at = VALUES(created_at), 
                    updated_at = NOW();
                        ");
            DB::commit();
            $this->info("Local Banks (Level I): $localBanks");
            $this->info("Local Banks (Level I) migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Local Banks (Level I) migration failed: ' . $e->getMessage());
        }



        //Organizations (cyclos group_id 14)
        DB::beginTransaction();
        try {
            $organizations = DB::affectingStatement("                        
                INSERT INTO {$destinationDb}.organizations (cyclos_id, name, full_name, email, email_verified_at, cyclos_salt, password, limit_min, limit_max, created_at, updated_at, last_login_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name, 
                    m.name AS full_name,
                    m.email AS email,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    u.salt AS cyclos_salt, 
                    u.password AS password,
                    " . $orgLimitMin . " as limit_min,
                    " . $orgLimitMax . " as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at,  
                    NOW() AS updated_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 14
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    email = VALUES(email), 
                    created_at = VALUES(created_at), 
                    updated_at = NOW();
                ");
            DB::commit();
            $this->info("Organizations: $organizations");
            $this->info("Organizations migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('User migration failed: ' . $e->getMessage());
        }




        //Projects to create Hours (Level II) (Cyclos group_id 15)
        DB::beginTransaction();

        try {
            $projectsCreateHour = DB::affectingStatement("
                INSERT INTO {$destinationDb}.banks (cyclos_id, name, full_name, email, email_verified_at, cyclos_salt, password, limit_min, limit_max, created_at, updated_at, last_login_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name, 
                    m.name AS full_name,
                    m.email AS email,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                    u.salt AS cyclos_salt, 
                    u.password AS password,
                    " . $bankLimitMin . " as limit_min,
                    " . $bankLimitMax . " as limit_max,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                    NOW() AS updated_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 15
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    email = VALUES(email), 
                    created_at = VALUES(created_at), 
                    updated_at = NOW();
                ");
            DB::commit();
            $this->info("Projects to create Hours (Level II): $projectsCreateHour");
            $this->info("Projects to create Hours (Level II) migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Projects to create Hours (Level II) migration failed: ' . $e->getMessage());
        }




        //TEST: Projects (Cyclos group_id 18)
        DB::beginTransaction();
        try {
            $projectsCreateHour = DB::affectingStatement("
            INSERT INTO {$destinationDb}.organizations (cyclos_id, name, full_name, email, email_verified_at, cyclos_salt, password, limit_min, limit_max, created_at, updated_at, last_login_at)
            SELECT 
                m.id AS cyclos_id, 
                u.username AS name, 
                m.name AS full_name,
                m.email AS email,
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                u.salt AS cyclos_salt, 
                u.password AS password,
                " . $orgLimitMin . " as limit_min,
                " . $orgLimitMax . " as limit_max,
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                NOW() AS updated_at,
                FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
            FROM `{$sourceDb}`.`members` m
            JOIN `{$sourceDb}`.`users` u ON m.id = u.id
            WHERE m.group_id = 18
            ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                email = VALUES(email), 
                created_at = VALUES(created_at), 
                updated_at = NOW();
            ");
            DB::commit();
            $this->info("TEST: Projects: $projectsCreateHour");
            $this->info("TEST: Projects migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('TEST: Projects migration failed: ' . $e->getMessage());
        }






        //TEST: Users (Cyclos group_id 18)
        DB::beginTransaction();
        try {
            $projectsCreateHour = DB::affectingStatement("
            INSERT INTO {$destinationDb}.users (cyclos_id, name, full_name, email, email_verified_at, cyclos_salt, password, limit_min, limit_max, created_at, updated_at, last_login_at)
            SELECT 
                m.id AS cyclos_id, 
                u.username AS name, 
                m.name AS full_name,
                m.email AS email,
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                u.salt AS cyclos_salt, 
                u.password AS password,
                " . $userLimitMin . " as limit_min,
                " . $userLimitMax . " as limit_max,
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                NOW() AS updated_at,
                FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at
            FROM `{$sourceDb}`.`members` m
            JOIN `{$sourceDb}`.`users` u ON m.id = u.id
            WHERE m.group_id = 22
            ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                email = VALUES(email), 
                created_at = VALUES(created_at), 
                updated_at = NOW();
            ");
            DB::commit();
            $this->info("TEST: Users: $projectsCreateHour");
            $this->info("TEST: Users migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('TEST: Users migration failed: ' . $e->getMessage());
        }





        // Inactive Projects (group_id 27)
        DB::beginTransaction();
        try {
            $inActiveUsers = DB::affectingStatement("                                
            INSERT INTO {$destinationDb}.organizations (cyclos_id, full_name, email, email_verified_at, created_at, updated_at, name, cyclos_salt, password, limit_min, limit_max, last_login_at, inactive_at)
            SELECT 
                m.id AS cyclos_id, 
                m.name AS full_name, 
                m.email AS email, 
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS email_verified_at, 
                FROM_UNIXTIME(UNIX_TIMESTAMP(m.creation_date)) AS created_at, 
                NOW() AS updated_at,
                u.username AS name, 
                u.salt AS cyclos_salt, 
                u.password AS password, 
                " . $orgLimitMin . " as limit_min,
                " . $orgLimitMax . " as limit_max,
                FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at,
                FROM_UNIXTIME(UNIX_TIMESTAMP(ghl.start_date)) AS inactive_at
            FROM `{$sourceDb}`.`members` m
            JOIN `{$sourceDb}`.`users` u ON m.id = u.id
            LEFT JOIN `{$sourceDb}`.`group_history_logs` ghl ON m.id = ghl.element_id
            WHERE ghl.group_id = 27 AND ghl.end_date IS NULL AND m.group_id = 27
            ON DUPLICATE KEY UPDATE 
                name = VALUES(name), 
                full_name = VALUES(full_name), 
                email = VALUES(email), 
                created_at = VALUES(created_at), 
                updated_at = NOW(),
                name = VALUES(name), 
                cyclos_salt = VALUES(cyclos_salt), 
                password = VALUES(password), 
                last_login_at = VALUES(last_login_at),
                inactive_at = VALUES(inactive_at);
            ");
            DB::commit();
            $this->info("Inactive projects: $inActiveUsers");
            $this->info("Inactive projects migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Inactive projects migration failed: ' . $e->getMessage());
        }






        // MIGRATE IMAGES
        DB::beginTransaction();

        try {

            $total_images = 0;

            // Select images with the lowest order_number for each member_id.
            // The image with lowest order_number will become the new Laravel profile image
            $minOrderImages = DB::table($sourceDb . '.images')
                                ->select('member_id', DB::raw('MIN(order_number) as min_order_number'))
                                ->groupBy('member_id');

            // Processing bank images
            $images = DB::table($sourceDb . '.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join($sourceDb . '.members as m', 'i.member_id', '=', 'm.id')
                        ->join($sourceDb . '.users as u', 'm.id', '=', 'u.id')
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->whereIn('m.group_id', [13, 15]) // Banks & Projects to create Hours
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'bank_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table($destinationDb . '.banks')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            // Records without profile photo
            DB::table($destinationDb . '.banks')
                ->whereNull('profile_photo_path')
                ->update(['profile_photo_path' => 'app-images/profile-user-default.svg']);
            $total_images += $images->count();
            $this->info('Banks: ' . $images->count() . ' images');





            // Processing user images
            $images = DB::table($sourceDb . '.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join($sourceDb . '.members as m', 'i.member_id', '=', 'm.id')
                        ->join($sourceDb . '.users as u', 'm.id', '=', 'u.id')
                        ->where('m.group_id', '=', 5) // Users
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'user_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table($destinationDb . '.users')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            // Records without profile photo
            DB::table($destinationDb . '.users')
                ->whereNull('profile_photo_path')
                ->update(['profile_photo_path' => 'app-images/profile-user-default.svg']);
            $total_images += $images->count();
            $this->info('Users: ' . $images->count() . ' images');


            // Processing organization images
            $images = DB::table($sourceDb . '.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join($sourceDb . '.members as m', 'i.member_id', '=', 'm.id')
                        ->join($sourceDb . '.users as u', 'm.id', '=', 'u.id')
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->where('m.group_id', '=', 14) // Orgaizations
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'organization_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table($destinationDb . '.organizations')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            // Records without profile photo
            DB::table($destinationDb . '.organizations')
                ->whereNull('profile_photo_path')
                ->update(['profile_photo_path' => 'app-images/profile-user-default.svg']);
            $total_images += $images->count();
            $this->info('Organizations: ' . $images->count() . ' images');
            $this->info('Total: ' . $total_images . ' images written to disk');

            DB::commit();
            $this->info("Images migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Images migration failed: ' . $e->getMessage());
        }


        // MIGRATE ACCOUNTS

        // Debit Account (cyclos type_id 1, id 1)
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (name, accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'Debit' AS name,
                    'App\\\\Models\\\\Bank' AS accountable_type,
                    1 AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    NULL AS limit_min,
                    0 AS limit_max
                FROM {$sourceDb}.accounts a
                WHERE a.type_id = 1;
            ");
            DB::commit();
            $this->info("Debit account: $accounts");
            $this->info("Debit account migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Debit account failed: ' . $e->getMessage());
        }


        // Community Account (cyclos type_id 2)
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (name, accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'Community' AS name,
                    'App\\\\Models\\\\Bank' AS accountable_type,
                    1 AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    0 AS limit_min,
                    NULL AS limit_max
                FROM {$sourceDb}.accounts a
                WHERE a.type_id = 2;
            ");
            DB::commit();
            $this->info("Community account: $accounts");
            $this->info("Community account migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Community account failed: ' . $e->getMessage());
        }




        // Work account of users (cyclos type_id 5)
        // Note that because of cyclos permission group changes, a Work account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\User' AS accountable_type,
                    u.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $userLimitMin . " as limit_min,
                    " . $userLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.users u ON a.member_id = u.cyclos_id
                WHERE a.type_id = 5;
            ");
            DB::commit();
            $this->info("Work account: $accounts");
            $this->info("Work account migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Work account migration failed: ' . $e->getMessage());
        }



        // Work account of organizations (cyclos type_id 5)
        // Note that because of cyclos permission group changes, a Work account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\Organization' AS accountable_type,
                    u.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $orgLimitMin . " as limit_min,
                    " . $orgLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.organizations u ON a.member_id = u.cyclos_id
                WHERE a.type_id = 5;
            ");
            DB::commit();
            $this->info("Work account organizations: $accounts");
            $this->info("Work account organizations migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Work account organizations migration failed: ' . $e->getMessage());
        }
            




        // Work account of banks (cyclos type_id 5)
        // Note that because of cyclos permission group changes, a Work account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\Bank' AS accountable_type,
                    u.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $bankLimitMin . " as limit_min,
                    " . $bankLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.banks u ON a.member_id = u.cyclos_id
                WHERE a.type_id = 5;
            ");
            DB::commit();
            $this->info("Work account banks: $accounts");
            $this->info("Work account banks migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Work banks organizations migration failed: ' . $e->getMessage());
        }






        // Gift account users (cyclos type_id 6)
        // Note that because of cyclos permission group changes, a Gift account can also be owned by Projects, Local banks etc.

        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (name, accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'Gift' AS name,
                    'App\\\\Models\\\\User' AS accountable_type,
                    u.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $userLimitMin . " as limit_min,
                    " . $userLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.users u ON a.member_id = u.cyclos_id
                WHERE a.type_id = 6;
            ");
            DB::commit();
            $this->info("Gift account users: $accounts");
            $this->info("Gift account users migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Gift account users migration failed: ' . $e->getMessage());
        }

        //TODO Remove this account on each user if it contains 0 transactions!




                
        // Gift account organizations (cyclos type_id 6)
        // Note that because of cyclos permission group changes, a Gift account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                    INSERT INTO {$destinationDb}.accounts (name, accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                    SELECT
                        'Gift' AS name,
                        'App\\\\Models\\\\Organization' AS accountable_type,
                        u.id AS accountable_id,
                        a.id AS cyclos_id,
                        a.creation_date AS created_at,
                        a.last_closing_date AS updated_at,
                        " . $orgLimitMin . " as limit_min,
                        " . $orgLimitMax . " as limit_max
                    FROM {$sourceDb}.accounts a
                    JOIN {$destinationDb}.organizations u ON a.member_id = u.cyclos_id
                    WHERE a.type_id = 6;
                ");
            DB::commit();
            $this->info("Gift account organizations: $accounts");
            $this->info("Gift account organizations migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Gift account organizations migration failed: ' . $e->getMessage());
        }





                
        // Gift account banks (cyclos type_id 6)
        // Note that because of cyclos permission group changes, a Gift account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                    INSERT INTO {$destinationDb}.accounts (name, accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                    SELECT
                        'Gift' AS name,
                        'App\\\\Models\\\\Bank' AS accountable_type,
                        u.id AS accountable_id,
                        a.id AS cyclos_id,
                        a.creation_date AS created_at,
                        a.last_closing_date AS updated_at,
                        " . $bankLimitMin . " as limit_min,
                        " . $bankLimitMax . " as limit_max
                    FROM {$sourceDb}.accounts a
                    JOIN {$destinationDb}.banks u ON a.member_id = u.cyclos_id
                    WHERE a.type_id = 6;
                ");
            DB::commit();
            $this->info("Gift account banks: $accounts");
            $this->info("Gift account banks migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Gift account banks migration failed: ' . $e->getMessage());
        }



  
        // Project account users (cyclos type_id 7)    
        // Note that because of cyclos permission group changes, a Project account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\User' AS accountable_type,
                    o.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $userLimitMin . " as limit_min,
                    " . $userLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.users o ON a.member_id = o.cyclos_id
                WHERE a.type_id = 7;
            ");
            DB::commit();
            $this->info("Project accounts users: $accounts");
            $this->info("Project accounts users completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Project accounts users failed: ' . $e->getMessage());
        }




        // Project account organizations (cyclos type_id 7)
        // Note that because of cyclos permission group changes, a Project account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\Organization' AS accountable_type,
                    o.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $orgLimitMin . " as limit_min,
                    " . $orgLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.organizations o ON a.member_id = o.cyclos_id
                WHERE a.type_id = 7;
            ");
            DB::commit();
            $this->info("Project accounts organizations: $accounts");
            $this->info("Project accounts organizations completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Project accounts organizations failed: ' . $e->getMessage());
        }



        // Project account banks (cyclos type_id 7)
        // Note that because of cyclos permission group changes, a Project account can also be owned by Projects, Local banks etc.
        DB::beginTransaction();

        try {
            $accounts = DB::affectingStatement("
                INSERT INTO {$destinationDb}.accounts (accountable_type, accountable_id, cyclos_id, created_at, updated_at, limit_min, limit_max)
                SELECT
                    'App\\\\Models\\\\Bank' AS accountable_type,
                    o.id AS accountable_id,
                    a.id AS cyclos_id,
                    a.creation_date AS created_at,
                    a.last_closing_date AS updated_at,
                    " . $bankLimitMin . " as limit_min,
                    " . $bankLimitMax . " as limit_max
                FROM {$sourceDb}.accounts a
                JOIN {$destinationDb}.banks o ON a.member_id = o.cyclos_id
                WHERE a.type_id = 7;
            ");
            DB::commit();
            $this->info("Project accounts banks: $accounts");
            $this->info("Project accounts banks completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Project accounts banks failed: ' . $e->getMessage());
        }




        // MIGRATE TRANSACTIONS     
        DB::beginTransaction();
        try {
            $transactions = DB::affectingStatement("
                INSERT INTO {$destinationDb}.transactions (from_account_id, to_account_id, amount, description, transaction_type_id, transaction_status_id, created_at, updated_at)
                SELECT 
                    fromAcc.id AS from_account_id, 
                    toAcc.id AS to_account_id, 
                    (t.amount * 60) AS amount, 
                    t.description AS description,
                    t.type_id AS transaction_type_id,
                    1 AS transaction_status_id,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(t.date)) AS created_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(t.date)) AS updated_at
                FROM `{$sourceDb}`.`transfers` t
                LEFT JOIN {$destinationDb}.accounts fromAcc ON t.from_account_id = fromAcc.cyclos_id
                LEFT JOIN {$destinationDb}.accounts toAcc ON t.to_account_id = toAcc.cyclos_id
            ");
            DB::commit();
            $this->info("Transactions: $transactions");
            $this->info("Transaction migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Transaction migration failed: ' . $e->getMessage());
        }
        $this->info("");


        
        // COMPARE MIGRATION TOTALS

        $cyclos_members = DB::table("{$sourceDb}.members")
            ->where('group_id', '<>', 17)   // do not count cyclos local admins, as they are not migrated
            ->count();   
        $users = DB::table("{$destinationDb}.users")
            ->count();        
        $organizations = DB::table("{$destinationDb}.organizations")
            ->count();            
        $banks = DB::table("{$destinationDb}.banks")
            ->where('id', '<>', 1)   // do not count source bank as it has no migrated cyclos_id
            ->count();
        $laravel_members = $users + $organizations + $banks;

        if ($cyclos_members != $laravel_members) {
            $this->error('Mismatch total members');
            $this->error('Source members: ' . $cyclos_members);
            $this->error('Destination members: ' . $laravel_members);
        } else {
            $this->info('CHECK MEMBER MIGRATION TOTALS: OK!');
        }

        $cyclos_transfers = DB::table("{$sourceDb}.transfers")
            ->count();
        if ($cyclos_transfers != $transactions) {    
            $this->error('Mismatch total transactions');
            $this->error('Source transactions: ' . $cyclos_transfers );
            $this->error('Destination transactions: ' . $transactions);
        } else {
            $this->info('CHECK TRANSACTION MIGRATION TOTALS: OK!');
        }
        

        
        // CHECK INTEGRITY OF TRANSACTIONS
        $combinedTransactions = DB::query()
            ->select('to_account_id as account_id', 'amount', DB::raw("'credit' as type"))
            ->from("{$destinationDb}.transactions")
            ->unionAll(
                DB::table("{$destinationDb}.transactions")
                    ->select('from_account_id as account_id', 'amount', DB::raw("'debit' as type"))
            );
        $accountBalances = DB::query()
            ->fromSub($combinedTransactions, 'combined_transactions')
            ->groupBy('account_id')
            ->select('account_id')
            ->selectRaw("SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) - SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as net_balance");
        $totalNetBalance = DB::query()
            ->fromSub($accountBalances, 'account_balances')
            ->selectRaw('SUM(net_balance) as total_net_balance')
            ->first();
        if ($totalNetBalance->total_net_balance != 0) {
            $this->error('Mismatch total amount transactions');
            $this->error("OUT OF BALANCE AMOUNT: {$totalNetBalance->total_net_balance}");
        } else {
            $this->info("Total Net Balance: {$totalNetBalance->total_net_balance}");
            $this->info("CHECK INTEGRITY OF BALANCES: OK!");
            $this->info("");
        }


        

        // REGISTRATION OF PACKAGE MODELS

        // Register laravel-love models
        $exitCode = Artisan::call('love:register-reacters', ['--model' => 'App\Models\User'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reacters registered: Users');
        } else {
            $this->error('Laravel-love Reacters registration failed: Users');
        }

        $exitCode = Artisan::call('love:register-reacters', ['--model' => 'App\Models\Organization'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reacters registered: Organizations');
        } else {
            $this->error('Laravel-love Reacters registration failed: Organizations');
        }


        $exitCode = Artisan::call('love:register-reactants', ['--model' => 'App\Models\User'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reactants registered: Users');
        } else {
            $this->error('Laravel-love Reactants registration failed.');
        }

        $exitCode = Artisan::call('love:register-reactants', ['--model' => 'App\Models\Organization'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reactants registered: Organizations');
        } else {
            $this->error('Laravel-love Reactants registration failed: Organizations');
        }

        $exitCode = Artisan::call('love:register-reactants', ['--model' => 'App\Models\Organization'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reactants registered: Organizations');
        } else {
            $this->error('Laravel-love Reactants registration failed: Organizations');
        }

        $exitCode = Artisan::call('love:register-reactants', ['--model' => 'App\Models\Bank'], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Laravel-love Reactants registered: Banks');
        } else {
            $this->error('Laravel-love Reactants registration failed.');
        }


        // Attach Messenger profiles
        $exitCode = Artisan::call('messenger:attach:messengers', [], new \Symfony\Component\Console\Output\ConsoleOutput());
        // Optionally, check if the command was successful
        if ($exitCode === 0) {
            $this->info('Rtippin Messenger providers registered.');
        } else {
            $this->error('Rtippin Messenger providers registration failed');
        }

        $this->warn('Do not run this migration again without refreshing the database and deleting all files in storage/app/public/profile-photo\'s');
        $this->warn('You can do this with the command: php artisan db:seed');
        $this->info('');
    }
}
