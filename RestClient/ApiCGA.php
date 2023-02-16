<?php

namespace RestClient;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

class ApiCGA extends GuzzleClient {

    public static function create($config = [], $bodyParams = []) {
        // Load the service description file.
        $service_description = new Description(
            ['baseUrl' => $config['base_uri']] + (array) json_decode(file_get_contents(__DIR__ . '/service.json'), TRUE)
        );

        // Creates the client and sets the default request headers.
        $clientConfig = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'api-key' => 'SzVlZGUwYzdjMTg1Y2M4LjM2NTM5MzYw',
            ]
        ];

        if (!empty($bodyParams)) {
            $clientConfig['json'] = $bodyParams;
        }

        $client = new Client($clientConfig);

        return new static($client, $service_description, NULL, NULL, NULL, $config);
    }
}