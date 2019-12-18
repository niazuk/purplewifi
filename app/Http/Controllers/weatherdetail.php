<?php
//https://stackoverflow.com/questions/22355828/doing-http-requests-from-laravel-to-an-external-api?rq=1
//https://www.taniarascia.com/how-to-use-json-data-with-php-or-javascript/

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class weatherdetail extends Controller
{
    //
    protected $weatherInfo = array( );
	public function index(){

		return view('index');


	}

	public function getLocationID(Request $request)
	{
		$client = new Client();
		$res = $client->request('GET', 'http://datapoint.metoffice.gov.uk/public/data/val/wxfcs/all/json/sitelist?key=cbd832bb-e163-413d-a2d1-f5619e86f558');
		//echo $res->getStatusCode();
		$json = $res->getBody()->getContents();
		//$json = json_decode($XML, true);
        // 200
		//echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
		$locations = json_decode($json,true);

		$locationID = '310013';

		foreach ($locations['Locations']['Location'] as $data) {
			if(isset($data['name'])){
				if( strstr($data['name'], $request['location'])){
					$locationID = $data['id'];
					break;
				}
			}

		}
		

		$url = 'http://datapoint.metoffice.gov.uk/public/data/val/wxfcs/all/json/'.$locationID.'?res=3hourly&key=cbd832bb-e163-413d-a2d1-f5619e86f558';

		$res = $client->request('GET', $url);
		//echo $res->getStatusCode();
		$json = $res->getBody()->getContents();

		$data = json_decode($json,true);
		$minTemp = 1000;
		$maxTemp = -1000;

		foreach($data['SiteRep']['DV']['Location']['Period'][1]['Rep'] as $temperature){
			if( strval($temperature['T']) < $minTemp){
				$minTemp = $temperature['T'];
				$minType = $temperature['W'];
			}
			if( strval($temperature['T']) > $maxTemp){
				$maxTemp = $temperature['T'];
				$maxType = $temperature['W'];
			}

		}

		$weatherInfo['location'] = $request['location'];
		$weatherInfo['date'] = $data['SiteRep']['DV']['Location']['Period'][1]['value'];
		$weatherInfo['minTemp'] = $minTemp;
		$weatherInfo['minType'] = config('weathertype.weatherType.'.$minType);
		$weatherInfo['maxTemp'] = $maxTemp;		
		$weatherInfo['maxType'] = config('weathertype.weatherType.'.$maxType);
		//echo($data['SiteRep']['DV']['Location']['Period'][1]['value'].$minTemp."   ".config('weathertype.weatherType.'.$minType)."<br>".$maxTemp."   ".config('weathertype.weatherType.'.$maxType));
		//echo($weatherInfo['maxType']);

		return view('index')->with('weatherInfo', $weatherInfo);

	}
}
