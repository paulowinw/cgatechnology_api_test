<?php
require_once __DIR__.'/vendor/autoload.php';

use RestClient\ApiCGA;

$apiClient = ApiCGA::create(
    [
        'base_uri' => 'https://demo.flexmms.com/v3/api/incidents/'
    ],
    [
        "view" => "detailed",
        "start" => 1613404241,
        "end" => 1676476251
    ]
);
$resultObject = $apiClient->getIncidents();
$resultArray = $resultObject->toArray();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultArray["results"]);
