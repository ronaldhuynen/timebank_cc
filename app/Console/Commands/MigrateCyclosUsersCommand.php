<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MigrateCyclosUsersCommand extends Command
{
    protected $signature = 'migrate:cyclos_users';
    protected $description = 'Migrates all Cyclos users from the old Cyclos database to the new Laravel database';

    public function handle()
    {
        
        // Ask for database names
        $sourceDb = $this->ask('Enter the name of the source database');
        $destinationDb = env('DB_DATABASE');

        

        
        // Active Users (group_id 5)
        DB::beginTransaction();

        try {
            $activeUsers = DB::affectingStatement("
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, created_at, updated_at, name, cyclos_salt, password, last_login_at)
                SELECT 
                    m.id AS cyclos_id, 
                    m.name AS full_name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at,
                    u.username AS name, 
                    u.salt, 
                    u.password, 
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
                $this->info("Users migration completed successfully.");

            } catch (\Exception $e) {
                DB::rollBack();
                $this->error('Users migration failed: ' . $e->getMessage());
            }



        
        // Inactive Users (group_id 6)
        DB::beginTransaction();

        try {
            $inActiveUsers = DB::affectingStatement("
                                    
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, created_at, updated_at, name, cyclos_salt, password, last_login_at, deleted_at)
                SELECT 
                    m.id AS cyclos_id, 
                    m.name AS full_name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at,
                    u.username AS name, 
                    u.salt AS cyclos_salt, 
                    u.password, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(ghl.start_date)) AS deleted_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                LEFT JOIN `{$sourceDb}`.`group_history_logs` ghl ON m.id = ghl.element_id
                WHERE m.group_id = 6
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
            $this->info("Inactive Users: $inActiveUsers");
            $this->info("Inactive Users migration completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Inactive Users migration failed: ' . $e->getMessage());
        }



        
        //Removed Users (cyclos group_id 8):
        DB::beginTransaction();

        try {
            $removedUsers = DB::affectingStatement("
                INSERT INTO {$destinationDb}.users (cyclos_id, full_name, email, created_at, updated_at, name, cyclos_salt, password, last_login_at, deleted_at)
                SELECT 
                    m.id AS cyclos_id, 
                    m.name AS full_name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at,
                    u.username AS name, 
                    u.salt AS cyclos_salt, 
                    u.password, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(u.last_login)) AS last_login_at,
                    FROM_UNIXTIME(UNIX_TIMESTAMP(ghl.start_date)) AS deleted_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                LEFT JOIN `{$sourceDb}`.`group_history_logs` ghl ON m.id = ghl.element_id
                WHERE m.group_id = 8
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
            $this->info("Removed Users migration completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Removed Users migration failed: ' . $e->getMessage());
        }



        
        //Local Bank (Level I) (Cyclos group_id 13)
        DB::beginTransaction();

        try {
            $localBanks = DB::affectingStatement("
                INSERT INTO {$destinationDb}.banks (cyclos_id, name, email, created_at, updated_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 13
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    email = VALUES(email), 
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
                INSERT INTO {$destinationDb}.organizations (cyclos_id, name, email, created_at, updated_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at
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
            $this->info("Organizations migration completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('User migration failed: ' . $e->getMessage());
        }



         //Local Bank (Level I) (Cyclos group_id 13)
        DB::beginTransaction();

        try {
            $localBanks = DB::affectingStatement("
                INSERT INTO {$destinationDb}.banks (cyclos_id, name, email, created_at, updated_at)
                SELECT 
                    m.id AS cyclos_id, 
                    u.username AS name, 
                    m.email, 
                    FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                    NOW() AS updated_at
                FROM `{$sourceDb}`.`members` m
                JOIN `{$sourceDb}`.`users` u ON m.id = u.id
                WHERE m.group_id = 13
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    email = VALUES(email), 
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



        //Projecs to create Hours (Level II) (Cyclos group_id 15)
        DB::beginTransaction();

        try {
            $projectsCreateHour = DB::affectingStatement("
                        INSERT INTO {$destinationDb}.banks (cyclos_id, name, email, created_at, updated_at)
                        SELECT 
                            m.id AS cyclos_id, 
                            u.username AS name, 
                            m.email, 
                            FROM_UNIXTIME(UNIX_TIMESTAMP(m.member_activation_date)) AS created_at, 
                            NOW() AS updated_at
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
            $this->info("Projecs to create Hours (Level II): $projectsCreateHour");
            $this->info("Projecs to create Hours (Level II) migration completed successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Projecs to create Hours (Level II) migration failed: ' . $e->getMessage());
        }



        // Migrate images
        DB::beginTransaction();

        try {
           
            $total_images = 0;

            // Select images with the lowest order_number for each member_id.
            // The image with lowest order_number will become the new Laravel profile image
            $minOrderImages = DB::table('timebank_2024_06_11.images')
                                ->select('member_id', DB::raw('MIN(order_number) as min_order_number'))
                                ->groupBy('member_id');

            // Processing bank images
            $images = DB::table('timebank_2024_06_11.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join('timebank_2024_06_11.members as m', 'i.member_id', '=', 'm.id')
                        ->join('timebank_2024_06_11.users as u', 'm.id', '=', 'u.id')
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->whereIn('m.group_id', [13, 15]) // Banks & Projects to create Hours
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'bank_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table('timebank_cc_2.banks')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            $total_images += $images->count();
            $this->info('Banks: ' . $images->count() . ' images');


            // Processing user images
            $images = DB::table('timebank_2024_06_11.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join('timebank_2024_06_11.members as m', 'i.member_id', '=', 'm.id')
                        ->join('timebank_2024_06_11.users as u', 'm.id', '=', 'u.id')
                        ->where('m.group_id', '=', 5) // Users
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'user_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table('timebank_cc_2.users')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            $total_images += $images->count();
            $this->info('Users: ' . $images->count() . ' images');


            // Processing organization images
            $images = DB::table('timebank_2024_06_11.images as i')
                        ->joinSub($minOrderImages, 'min_order_images', function ($join) {
                            $join->on('i.member_id', '=', 'min_order_images.member_id')
                                ->on('i.order_number', '=', 'min_order_images.min_order_number');
                        })
                        ->join('timebank_2024_06_11.members as m', 'i.member_id', '=', 'm.id')
                        ->join('timebank_2024_06_11.users as u', 'm.id', '=', 'u.id')
                        ->select('i.image', 'u.id', 'i.member_id', 'i.order_number')
                        ->where('m.group_id', '=', 14) // Orgaizations
                        ->get();
            foreach ($images as $image) {
                $filename = 'profile-photos/' . 'organization_' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $image->image);
                $path = $filename;
                DB::table('timebank_cc_2.organizations')
                    ->where('cyclos_id', $image->id)
                    ->update(['profile_photo_path' => $path]);
            }
            $total_images += $images->count();
            $this->info('Organizations: ' . $images->count() . ' images');
            $this->info('Total: ' . $total_images . ' images written to disk');

            DB::commit();
            $this->info("Images migration completed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Images migration failed: ' . $e->getMessage());



            // TODO Attach Messenger profiles?


        }
        $this->warn('Do not run this migration again without refreshing the database and deleting all files in storage/app/public/profile-photo\'s');
    }
}
