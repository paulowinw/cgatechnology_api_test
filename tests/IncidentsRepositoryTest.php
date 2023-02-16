<?php

use PHPUnit\Framework\TestCase;

use FooApi\RestClient\FooClient;
use GuzzleHttp\Command\ResultInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Tests\Server;

final class IncidentsRepositoryTest extends TestCase
{
    public function setUp() {
        parent::setUp();

        // Load and start the guzzle test server.
        require_once __DIR__ . '/../../vendor/guzzlehttp/guzzle/tests/Server.php';
        Server::start();
        register_shutdown_function(function(){Server::stop();});

        $this->client = FooClient::create([
            'base_uri' => Server::$url,
            'api_user' => $_SERVER['FOO_USER'],
            'api_pass' => $_SERVER['FOO_PASS'],
        ]);
    }

    public function testGetIncidentsByRangeDate() {
        $foo = [
            'id' => '1',
            'name' => 'Foo',
            'description' => 'The best ever Foo.',
        ];
        Server::enqueue([new Response(200, [], json_encode(['status' => 'OK','Foo' => $foo], TRUE))]);
        $response = $this->client->GetFoo();

        self::assertInstanceOf(ResultInterface::class, $response);
        self::assertEquals($foo, $response->toArray()['Foo']);
    }
}