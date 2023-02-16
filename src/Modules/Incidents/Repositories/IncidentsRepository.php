<?php

namespace Modules\Incidents\Repositories;

use RestClient\ApiCGABuilder;
class IncidentsRepository {
    const BASE_URI = "https://demo.flexmms.com/v3/api/incidents/";

    private ApiCGABuilder $apiCGA;
    private array $results;
    public function __construct() {
        $apiCGA = new ApiCGABuilder(['base_uri' => self::BASE_URI]);
        $this->apiCGA = $apiCGA;
    }

    public function jsonExit(){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->results);
    }

    public function getIncidentsByRangeDate($start, $end) {
        $results = $this->apiCGA->setBody([
                "view" => "detailed",
                "start" => $start,
                "end" => $end
            ])
            ->exec()
            ->getIncidents()
            ->toArray()["results"];

        $this->results = $results;

        return $results;
    }

    public function getIncidentProjectsByRangeDate($start, $end) {
        $resultArray = $this->getIncidentsByRangeDate($start, $end);

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

        $this->results = $projectReferences;

        return $projectReferences;
    }
    

}