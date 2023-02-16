<?php

namespace RestClient;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

class ApiCGABuilder {

    private $serviceDescription;
    private $clientConfig;
    public function __construct($config = []) {
        $this->serviceDescription = new Description(
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

        $this->clientConfig = $clientConfig;
    }

    public function exec() {
        $client = new Client($this->clientConfig);

        return new GuzzleClient($client, $this->serviceDescription, NULL, NULL, NULL, $this->clientConfig);
    }

    public function setBody($bodyParams) {
        $this->clientConfig['json'] = $bodyParams;

        return $this;
    }
}