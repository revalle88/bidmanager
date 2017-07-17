<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;

class UserConnTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
	 $client = new Client();
    $response = $client->post('https://api-sandbox.direct.yandex.ru/v4/json/', [
    'json' => ['token' => 'AQAAAAACJo7AAARmcq7Th6ZGH0j8obUVp5GdNco',
				'method' => 'GetClientInfo',
				'param' => array('slide58')]
]);


	
        $this->assertTrue($response->getStatusCode()=="200");
    }
}
