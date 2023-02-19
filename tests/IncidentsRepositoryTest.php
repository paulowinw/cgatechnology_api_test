<?php

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;
use Modules\Incidents\Repositories\IncidentsRepository;

final class IncidentsRepositoryTest extends TestCase
{
    public function testCgaServerIsOn() {
        $http = new Client(['base_uri' => IncidentsRepository::BASE_URI]);
        $response = $http->request('GET', 'user-agent');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetIncidentsByRangeDate() {
        $repo = new IncidentsRepository();

        $result = $repo->getIncidentsByRangeDate("1/1/2022", "1/1/2023");
        $this->assertArrayHasKey(0, $result); // Check if it returs non empty result
    }

    public function testGetIncidentProjectsByRangeDate() {
        $repo = new IncidentsRepository();

        $result = $repo->getIncidentProjectsByRangeDate("1/1/2022", "1/1/2023");
        $this->assertArrayHasKey(0, $result); // Check if it returs non empty result
    }

}