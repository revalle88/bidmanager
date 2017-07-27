<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;
class ReportsController extends Controller
{
   
	
	public function getReport()
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
					"Accept-Language: en\n",  
					"returnMoneyInMicros\n",                           // Language for response messages
				//	"Content-Type: application/json; charset=utf-8"    // Data type and request encoding
		);


$body = "<?xml version='1.0' encoding='UTF-8'?>
    <ReportDefinition xmlns='http://api.direct.yandex.com/v5/reports'>
     <SelectionCriteria>
        <Filter>
        </Filter>
      </SelectionCriteria>
      <FieldNames>Date</FieldNames>
      <FieldNames>CampaignId</FieldNames>
      <FieldNames>Clicks</FieldNames>
      <FieldNames>Cost</FieldNames>
      <OrderBy>
        <Field>Date</Field>
      </OrderBy>
      <ReportName>Actual Data</ReportName>
      <ReportType>CAMPAIGN_PERFORMANCE_REPORT</ReportType>
      <DateRangeType>AUTO</DateRangeType>
      <Format>TSV</Format>
      <IncludeVAT>YES</IncludeVAT>
      <IncludeDiscount>YES</IncludeDiscount>
    </ReportDefinition>"














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
  // $result = json_decode($result);
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

		return view('pages.reports');
		
	}
	

	
	

	
	
	
	
	
	
	
	
}
