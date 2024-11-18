<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait LocationTrait
{
    /**
     * Get the profile's location and optionally generate a link to OpenStreetMap.
     * Attention: do not extensively use the $lookUpOsmLocation as too many request will be rate-limited!
     *
     * @return void
     */
    public function getLocationFirst($lookUpOsmLocation = false)
    {
        // Initialize variables
        $location = '';
        $country = '';
        $division = '';
        $city = '';
        $district = '';
        $locationData = [];

        $firstLocation = $this->locations->first();

        if ($firstLocation) {
            if (isset($firstLocation->city)) {
                $cityTranslation = $firstLocation->city->translations->first();
                $city = $cityTranslation ? $cityTranslation->name : '';
                $location = $city;
            }
            if (isset($firstLocation->district)) {
                $districtTranslation = $firstLocation->district->translations->first();
                $district = $districtTranslation ? $districtTranslation->name : '';
                $location = $city ? $city . ' ' . $district : $district;
            }
            if (isset($firstLocation->division)) {
                $divisionTranslation = $firstLocation->division->translations->first();
                $division = $divisionTranslation ? $divisionTranslation->name : '';
                $location = $city || $district ? $location . ', ' . $division : $division;
            }
            if (isset($firstLocation->country)) {
                $country = $firstLocation->country->code;
                $countryName = $firstLocation->country->translations->first()->name;
                $location = $city || $district || $division ? $location . ', ' . $country : $country;
            }
        }

        // Remove trailing comma and space
        $locationName = rtrim($location, ', ');
        $locationData['name'] = $locationName;
            
        // Construct name_short based on available properties
        $nameShortParts = [];

        if ($district) {
            $nameShortParts[] = $district;
        }
        if ($city && count($nameShortParts) < 2) {
            $nameShortParts[] = $city;
        }
        if ($division && count($nameShortParts) < 2) {
            $nameShortParts[] = $division;
        }
        if (!$city && $country && count($nameShortParts) < 2) {
            $nameShortParts[] = $countryName;
        }

        // Join the parts with a comma and space
        $locationData['name_short'] = implode(', ', $nameShortParts);


        if ($lookUpOsmLocation == true) {
            // Construct the URL for Nominatim search
            $searchUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($locationName);

            // Define your User-Agent
            $userAgent = 'Timebank.cc (admin@timebank.cc)';

            // Send the HTTP request to the Nominatim API
            $response = Http::withHeaders([
                'User-Agent' => $userAgent,
            ])->get($searchUrl);

            // Parse the JSON response
            $data = $response->json();

            // Extract the first result's coordinates (if available)
            if (!empty($data[0])) {
                $latitude = $data[0]['lat'];
                $longitude = $data[0]['lon'];

                // Create the OpenStreetMap URL with the coordinates
                $locationData['url'] = "https://www.openstreetmap.org/?mlat={$latitude}&mlon={$longitude}#map=12/{$latitude}/{$longitude}";
            } else {
                $locationData['url'] = null; // No location found
            }
        }

        return $locationData;
    }
}
