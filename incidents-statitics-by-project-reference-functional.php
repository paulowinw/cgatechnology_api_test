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
$resultArray = $resultObject->toArray()["results"];
$quantityIncidents = count($resultArray);

$groupedIncidents = [];
foreach ($resultArray as $item) {
    $groupedIncidents[$item['projectReference']][] = $item;
}

$projectReferences = [];
foreach ($groupedIncidents as $key => $item) {
    $quantityOfGroup = count($item);
    $projectReferences[] = [
        'projectReference' => $key,
        'project' => $item[0]['project'],
        'quantity' => $quantityOfGroup,
        'percentage' => number_format(($quantityOfGroup / $quantityIncidents) * 100, 0),
    ];
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($projectReferences);
