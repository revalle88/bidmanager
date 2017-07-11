<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;
class TestController extends Controller
{
    public function connect()
	{
	

	//$req = new HTTP_Request("https://api.direct.yandex.ru/v4/json/");
	
    $client = new Client();
    $response = $client->post('https://api-sandbox.direct.yandex.ru/v4/json/', [
    'json' => ['token' => 'AQAAAAACJo7AAARmcq7Th6ZGH0j8obUVp5GdNco',
				'method' => 'GetClientInfo',
				'param' => array('slide58')]
]);

echo $response->getStatusCode();      // >>> 200
echo $response->getReasonPhrase();    // >>> OK
$contents = (string) $response->getBody();
echo $contents;
		return view('pages.personal');
		
	}
	
	
	 public function panel()
	{
		return view('pages.conpanel');
	}
}
