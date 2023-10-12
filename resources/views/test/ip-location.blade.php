<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Location test page - (location is not correct for localhost) </h1>
    <div class="card">
        <div class="card-body">
            @if($IpLocationInfo)
                <h4>IP: {{ $IpLocationInfo->ip }}</h4>
                <h4>Country Name: {{ $IpLocationInfo->countryName }}</h4>
                <h4>Country Code: {{ $IpLocationInfo->countryCode }}</h4>
                <h4>Region Code: {{ $IpLocationInfo->regionCode }}</h4>
                <h4>Region Name: {{ $IpLocationInfo->regionName }}</h4>
                <h4>City Name: {{ $IpLocationInfo->cityName }}</h4>
                <h4>Zip Code: {{ $IpLocationInfo->zipCode }}</h4>
                <h4>iso Code: {{ $IpLocationInfo->isoCode }}</h4>
                <h4>Postal Code: {{ $IpLocationInfo->postalCode }}</h4>
                <h4>Latitude: {{ $IpLocationInfo->latitude }}</h4>
                <h4>Longitude: {{ $IpLocationInfo->longitude }}</h4>
                <h4>MetroCode: {{ $IpLocationInfo->metroCode }}</h4>
                <h4>Area Code {{ $IpLocationInfo->areaCode }}</h4>
                <h4>Driver: {{ $IpLocationInfo->driver }}</h4>
            @endif
        </div>

        
    </div>
</div>

</body>
</html>