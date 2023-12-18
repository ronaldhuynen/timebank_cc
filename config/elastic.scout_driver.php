<?php declare(strict_types=1);

return [
    'refresh_documents' => env('ELASTIC_SCOUT_DRIVER_REFRESH_DOCUMENTS', true), //true: documents are indexed immediately, which might be handy for testing.
];
