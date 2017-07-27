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
		'json' => ['token' => 'AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk',
				'method' => 'GetClientInfo',
				'param' => array('test.gradient')]
								]);
				//AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk test.gradient
				//AQAAAAACJo7AAARmcq7Th6ZGH0j8obUVp5GdNco slide58
		echo $response->getStatusCode();      // >>> 200
		echo $response->getReasonPhrase();    // >>> OK
		$contents = (string) $response->getBody();
		echo $contents;
	return view('pages.personal');
		
	}
	
	public function getCompains2()
	{
	
		//--- Input data ----------------------------------------------------//
		// Address of the Campaigns service for sending JSON requests (case-sensitive)
		$url = 'https://api-sandbox.direct.yandex.ru/v4/json/';
		// OAuth token of the user to execute requests on behalf of
		$token = 'AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk';
		// Username of the advertising agency client
		// Required parameter if requests are made on behalf of an advertising agency
		$clientLogin = 'test.gradient';

		//--- Preparing and executing the request -----------------------------------//
		// Setting the request HTTP headers
		$headers = array(
					"Authorization: Bearer AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk\n",                    // OAuth token. The word Bearer must be used
					"Client-Login: test.gradient\n",                      // Username of the advertising agency client
					"Accept-Language: en",                             // Language for response messages
					"Content-Type: application/json; charset=utf-8"    // Data type and request encoding
		);

		// Parameters for the request to the Yandex.Direct API server
		$params = array(
				'method' => 'get',                                 // Method of the Campaigns service
				'params' => array(
				'SelectionCriteria' => (object) array(),        // Criteria for filtering campaigns. To get all campaigns, leave it empty
				'FieldNames' => array('Id', 'Name')             // Names of parameters to get
			)
		);
			// Converting input parameters to JSON
		$body = json_encode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		var_dump($body);
		// Creating the stream context: setting the HTTP headers and message body
		$streamOptions = stream_context_create(array(
				'http' => array(
				'method' => 'POST',
				'header' => $headers,
				'content' => $body
		),
  
));

// Executing the request and getting the result
$result = file_get_contents($url, 0, $streamOptions);
echo "hello";
//--- Processing the result ---------------------------//
if ($result === false) { echo "Request execution error!"; }
else {
   // Converting the response from JSON
   $result = json_decode($result);
var_dump($result);
   if (isset($result->error_code)) {
     
      echo "API error  {$result->error_str} )";
   }
   else {
      // Extracting the HTTP response headers: RequestId (ID of the request) and Units (information about points)
      foreach ($http_response_header as $header) {
         if (preg_match('/(RequestId|Units):/', $header)) { echo "$header <br>"; }
      }

      // Outputting a list of advertising campaigns
      foreach ($result->result->Campaigns as $campaign) {
         echo "Advertising campaign: {$campaign->Name} ({$campaign->Id})<br>";
      }
   }   
}

		return view('pages.compains');
		
	}
	
public function getCompains($login){

	$request = array(
    'method' => 'get',
    'params' => [
        'SelectionCriteria' => [
            "Statuses" => ["ACCEPTED"]
        ],
        'FieldNames' => [
                "Id",
                "Name",
				"StartDate",
				"Funds"
            ]
     ]);
	
	$request = json_encode($request);
	$opts = array(
		'http' => array(
        'method' => "GET",
        'header' => "Authorization: Bearer AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk\n" .
					"Accept-Language: ru\n" .
					"Client-Login: $login\n" .
					"Content-Type: application/json; charset=utf-8",
        'content' => $request,
		)
	);
	$context = stream_context_create($opts);
	$result = file_get_contents('https://api-sandbox.direct.yandex.com/json/v5/campaigns', 0, $context);


//	$result = json_decode($result, TRUE);
	$resultObj = json_decode($result);
	var_dump($resultObj);
	echo "<br>";
	var_dump($resultObj->result->Campaigns);
/*	if (isset($result->error_code)) {
		echo "!!!!!!!!!!!!!!!!";
    //  echo "API error  {$result->error_string} )";
	}
	var_dump($result);
	$campaigns =  $result['result']['Campaigns'];*/
return view('pages.compains')->with('campaigns', $resultObj->result->Campaigns);

}
	
	
	public function getSubClients(){
	$client = new Client();
   	$param = array(
		'Login' => 'test.gradient',
		'Filter' => array(
		'StatusArch' => 'No'
		),
	);
   
    $response = $client->post('https://api-sandbox.direct.yandex.ru/v4/json/', [
    'json' => ['token' => 'AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk',
				'method' => 'GetSubClients',
				'param' => $param]
	]);


	//AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk test.gradient
	//AQAAAAACJo7AAARmcq7Th6ZGH0j8obUVp5GdNco slide58
	echo $response->getStatusCode();      // >>> 200
	echo $response->getReasonPhrase();    // >>> OK
	$contents = (string) $response->getBody();
	echo $contents;
	$result = json_decode($response->getBody(), TRUE);
	foreach ($result['data'] as $item) {
    echo $item['Login'];
	}
	$resultObj = json_decode($response->getBody());
	foreach ($resultObj->data as $item) {
    echo $item->Login;
	}
	
	/*$subLogins =  $result['data']['Login'];
	
	echo $subLogins;*/
	return view('pages.subclients')->with('logins',$resultObj);
		

	
	}
	
	
	 public function panel()
	{
		$client = new Client();
		$param = array(
			'Login' => 'test.gradient',
			'Filter' => array(
			'StatusArch' => 'No'
			),
	);
   
    $response = $client->post('https://api-sandbox.direct.yandex.ru/v4/json/', [
    'json' => ['token' => 'AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk',
				'method' => 'GetSubClients',
				'param' => $param]
	]);


	//AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk test.gradient
	//AQAAAAACJo7AAARmcq7Th6ZGH0j8obUVp5GdNco slide58
/*	echo $response->getStatusCode();      // >>> 200
	echo $response->getReasonPhrase();    // >>> OK*/
	$contents = (string) $response->getBody();
	//echo $contents;
	$result = json_decode($response->getBody(), TRUE);
	$resultObj = json_decode($response->getBody());
	
	
		return view('pages.conpanel')->with('logins',$resultObj);
	}






	//////////////////////reports
	public function getReports()
	{
	
		//--- Input data ----------------------------------------------------//
		// Address of the Campaigns service for sending JSON requests (case-sensitive)
		$url = 'http://api.direct.yandex.com/v5/reports';
		// OAuth token of the user to execute requests on behalf of
		$token = 'AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk';
		// Username of the advertising agency client
		// Required parameter if requests are made on behalf of an advertising agency
		$clientLogin = 'test.gradient';

		//--- Preparing and executing the request -----------------------------------//
		// Setting the request HTTP headers
		$headers = array(
					"Authorization: Bearer AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk\n",                    // OAuth token. The word Bearer must be used
					"Client-Login: test.gradient\n",                      // Username of the advertising agency client
					"Accept-Language: en\n",  
					"returnMoneyInMicros\n",                           // Language for response messages
					"Content-Type: application/xml; charset=utf-8"    // Data type and request encoding
		);


$xmlBody = "<?xml version='1.0' encoding='UTF-8'?><ReportDefinition xmlns='http://api.direct.yandex.com/v5/reports'><SelectionCriteria><Filter></Filter></SelectionCriteria><FieldNames>Date</FieldNames><FieldNames>CampaignId</FieldNames><FieldNames>Clicks</FieldNames><FieldNames>Cost</FieldNames><OrderBy><Field>Date</Field></OrderBy><ReportName>Actual Data</ReportName><ReportType>CAMPAIGN_PERFORMANCE_REPORT</ReportType><DateRangeType>AUTO</DateRangeType><Format>TSV</Format><IncludeVAT>YES</IncludeVAT><IncludeDiscount>YES</IncludeDiscount></ReportDefinition>";
$post_data = array('xml' => $xmlBody);

		// Parameters for the request to the Yandex.Direct API server
		/*$params = array(
				'method' => 'get',                                 // Method of the Campaigns service
				'params' => array(
				'SelectionCriteria' => (object) array(),        // Criteria for filtering campaigns. To get all campaigns, leave it empty
				'FieldNames' => array('Id', 'Name')             // Names of parameters to get
			)
		);
			// Converting input parameters to JSON
		$body = json_encode($params, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);*/
		//echo $body;
		//echo $post_data;
		echo "</br>";
		//var_dump($body);
		// Creating the stream context: setting the HTTP headers and message body
		$streamOptions = stream_context_create(array(
				'http' => array(
				'method' => 'POST',
				'header' => $headers,
				'content' => http_build_query($post_data)
		),
  
));

// Executing the request and getting the result
$result = file_get_contents($url, 0, $streamOptions);
echo "hello</br>";
//--- Processing the result ---------------------------//

var_dump($result);
  

		return view('pages.reports');
		
	}
	

	
public function getReport($login)
	{
			$headers = array(

					"Authorization: Bearer AQAAAAAfNADPAARs8_hXK0DksE3nlBtnQogvjKk",                    // OAuth token. The word Bearer must be used
					   
					"Accept-Language: en",  
					"Client-Login: $login",  
					                 // Username of the advertising agency client
				    "returnMoneyInMicros: false",
					"Content-Type: application/xml; charset=utf-8"    // Data type and request encoding
			);

			$xmlBody = "<?xml version='1.0' encoding='UTF-8'?><ReportDefinition xmlns='http://api.direct.yandex.com/v5/reports'>
			<SelectionCriteria></SelectionCriteria>
			<FieldNames>CampaignId</FieldNames><FieldNames>Clicks</FieldNames><FieldNames>Cost</FieldNames><ReportName>Actual Data</ReportName><ReportType>CAMPAIGN_PERFORMANCE_REPORT</ReportType><DateRangeType>AUTO</DateRangeType><Format>TSV</Format><IncludeVAT>YES</IncludeVAT><IncludeDiscount>YES</IncludeDiscount></ReportDefinition>";

$post_data = array('xml' => $xmlBody);
//var_dump($xmlBody);
//var_dump($post_data);

			$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.direct.yandex.com/v5/reports");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlBody);
$content=curl_exec($ch);
echo $content;
	return view('pages.reports')->with('content',$content);
	
	}
	
	
	
	
	
	
}
