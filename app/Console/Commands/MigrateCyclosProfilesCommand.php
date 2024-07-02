<?php

namespace App\Console\Commands;

use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateCyclosProfilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:cyclos_profiles';
    protected $description = 'Migrates the Cyclos profile contents from the old Cyclos database to the new Laravel database';

    public function handle()
    {
        // Ask for database names
        //$sourceDb = $this->ask('Enter the name of the source database');
        // Or define database name
        $sourceDb = 'timebank_2024_06_11';
        $destinationDb = env('DB_DATABASE');





        // Migrate phone field
        // TODO clean and reformat values? Must be done when county is also set in profile
        $tables = ['users', 'organizations', 'banks'];

        foreach ($tables as $tableName) {
            DB::beginTransaction();
            try {
                $affectedRows = DB::affectingStatement("
                        UPDATE `{$destinationDb}`.`{$tableName}` dest
                        JOIN (
                            SELECT 
                                c.member_id,
                                LEFT(c.string_value, 20) AS phone  -- Truncate to 20 characters
                            FROM `{$sourceDb}`.`custom_field_values` c
                            WHERE c.field_id = 7
                        ) src ON dest.cyclos_id = src.member_id
                        SET dest.phone = src.phone
                    ");
                DB::commit();
                $this->info(ucfirst($tableName) . " phone field updated for $affectedRows records");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error(ucfirst($tableName) . " phone field migration failed: " . $e->getMessage());
            }
        }



        
        // Migrate locations

        $countryCodeMap = [
            860 => 2, // BE
            861 => 7, // PT
            862 => 1, // NL
            863 => null, // country not set / other country
        ];
        $cityCodeMap = [
            864 => 188, // Amsterdam
            865 => 200, // Haarlem
            866 => 316, // Leiden
            867 => 305, // The Hague
            868 => 300, // Delft
            869 => 331, // Rotterdam
            870 => 272, // Utrecht
            881 => 345, // Brussels
        ];

        $updatedRecordsCount = 0;

        DB::beginTransaction();
        try {
            // Wrap the migration calls in a function that returns the count of updated records
            $updatedRecordsCount += $this->migrateLocationData('User', $destinationDb, $sourceDb, $countryCodeMap, $cityCodeMap);
            $updatedRecordsCount += $this->migrateLocationData('Organization', $destinationDb, $sourceDb, $countryCodeMap, $cityCodeMap);
            $updatedRecordsCount += $this->migrateLocationData('Bank', $destinationDb, $sourceDb, $countryCodeMap, $cityCodeMap);

            DB::commit();
            // Output the total number of records updated
            $this->info("Location fields migration updated for: " . $updatedRecordsCount);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Location fields migration failed: " . $e->getMessage());
        }







        // Migrate user about field
        $tables = ['users'];
        foreach ($tables as $tableName) {
            DB::beginTransaction();
            try {
                $affectedRows = DB::affectingStatement("
                                        UPDATE `{$destinationDb}`.`{$tableName}` dest
                                        JOIN (
                                            SELECT 
                                                c.member_id,
                                                c.string_value AS about 
                                            FROM `{$sourceDb}`.`custom_field_values` c
                                            WHERE c.field_id = 17
                                        ) src ON dest.cyclos_id = src.member_id
                                        SET dest.about = src.about
                                    ");
                DB::commit();
                $this->info(ucfirst($tableName) . " about field updated for $affectedRows records");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error(ucfirst($tableName) . " about field migration failed: " . $e->getMessage());
            }
        }


        // Migrate website field
        $tables = ['users', 'organizations', 'banks'];
        foreach ($tables as $tableName) {
            DB::beginTransaction();
            try {
                $affectedRows = DB::affectingStatement("
                                                UPDATE `{$destinationDb}`.`{$tableName}` dest
                                                JOIN (
                                                    SELECT 
                                                        c.member_id,
                                                        c.string_value AS website 
                                                    FROM `{$sourceDb}`.`custom_field_values` c
                                                    WHERE c.field_id = 10
                                                ) src ON dest.cyclos_id = src.member_id
                                                SET dest.website = src.website
                                            ");
                DB::commit();
                $this->info(ucfirst($tableName) . " website field updated for $affectedRows records");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error(ucfirst($tableName) . " website field  migration failed: " . $e->getMessage());
            }
        }


        // Migrate website field
        $tables = ['users', 'organizations', 'banks'];
        foreach ($tables as $tableName) {
            DB::beginTransaction();
            try {
                $affectedRows = DB::affectingStatement("
                                                        UPDATE `{$destinationDb}`.`{$tableName}` dest
                                                        JOIN (
                                                            SELECT 
                                                                c.member_id,
                                                                c.string_value AS motivation 
                                                            FROM `{$sourceDb}`.`custom_field_values` c
                                                            WHERE c.field_id = 35
                                                        ) src ON dest.cyclos_id = src.member_id
                                                        SET dest.motivation = src.motivation
                                                    ");
                DB::commit();
                $this->info(ucfirst($tableName) . " motivation field updated for $affectedRows records");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error(ucfirst($tableName) . " motivation field  migration failed: " . $e->getMessage());
            }
        }



        // Migrate birthday field
        $tables = ['users'];
        foreach ($tables as $tableName) {
            DB::beginTransaction();
            try {
                $affectedRows = DB::affectingStatement("
                        UPDATE `{$destinationDb}`.`{$tableName}` dest
                        JOIN (
                            SELECT 
                                c.member_id,
                                STR_TO_DATE(REPLACE(c.string_value, '/', '-'), '%d-%m-%Y') AS birthday
                            FROM `{$sourceDb}`.`custom_field_values` c
                            WHERE c.field_id = 1
                        ) src ON dest.cyclos_id = src.member_id
                        SET dest.date_of_birth = src.birthday
                    ");
                DB::commit();
                $this->info(ucfirst($tableName) . " birthday field updated for $affectedRows records");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error(ucfirst($tableName) . " birthday field  migration failed: " . $e->getMessage());
            }
        }

    }






    protected function migrateLocationData($modelClass, $destinationDb, $sourceDb, $countryCodeMap, $cityCodeMap)
    {
        $fullyQualifiedModelClass = "App\\Models\\" . $modelClass;

        $cyclos_countries = DB::table("{$sourceDb}.custom_field_values")
                            ->where('field_id', 36)
                            ->get(['possible_value_id', 'member_id']);
        $cyclos_cities = DB::table("{$sourceDb}.custom_field_values")
                            ->where('field_id', 38)
                            ->get(['possible_value_id', 'member_id']);

        $remappedCountries = $cyclos_countries->mapWithKeys(function ($item) use ($countryCodeMap) {
            return [$item->member_id => $countryCodeMap[$item->possible_value_id] ?? null];
        });
        $remappedCities = $cyclos_cities->mapWithKeys(function ($item) use ($cityCodeMap) {
            return [$item->member_id => $cityCodeMap[$item->possible_value_id] ?? null];
        });

        $recordUpdateCount = 0;

        foreach ($remappedCountries as $memberId => $countryId) {
            $cityId = $remappedCities[$memberId] ?? null;
            if ($countryId !== null || $cityId !== null) {
                $entity = DB::table("{$destinationDb}." . strtolower($modelClass) . "s")
                            ->where('cyclos_id', $memberId)
                            ->first();

                if ($entity) {
                    $entityModel = $fullyQualifiedModelClass::find($entity->id);
                    if ($entityModel) {
                        $location = new Location();
                        $location->name = '__("Default location")';
                        $location->country_id = $countryId;
                        $location->city_id = $cityId;
                        $entityModel->locations()->save($location);
                        $recordUpdateCount++;
                    }
                }
            }
        }

        return $recordUpdateCount;
    }
}
