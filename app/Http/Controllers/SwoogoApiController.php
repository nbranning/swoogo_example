<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SwoogoApiController extends Controller
{
    private $authToken;
    private $bearerToken;
    private $base_url;
    private $event_id;


    public function __construct(){
        $key = config('swoogo.api_key');
        $secret = config('swoogo.api_secret');
        $this->authToken = base64_encode($key.':'.$secret);
        $this->base_url = config('swoogo.base_url');
        $this->event_id = config('swoogo.event_id');
        $this->setBearerToken();
    }

    public function getEvent(){
        //get specific event
        $event = $this->sendGetRequest('events/'.$this->event_id.'.json');
        // normally we would do error handling here 
        return $event;
    }

    public function getEventSessions(){
        //get sessions and speakers
        $sesions = $this->sendGetRequest('sessions.json?event_id='.$this->event_id.'&expand=speakers,location&fields=description,date,start_time,end_time,notes,location,name,id');
        // normally we would do error handling here 
        return $sesions->items;
    }

    private function setBearerToken(){
        $url = $this->base_url.'oauth2/token.json';

        //for some reason the api does not like how laravel http client handles the headers 
        // $headers = [
        //     'Content-Type'=>'application/x-www-form-urlencoded',
        //     'Authorization'=>'Basic '.$this->authToken
        // ];
        // // dd($url);
        // $response = Http::withHeaders($headers)->post($url, ['grant_type=client_credentials']);

        // dd($response);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic '.$this->authToken
            ],
        ]);

        $json = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($json);
        $this->bearerToken = $response->access_token;
    }

    private function sendGetRequest($endpoint){
        $url = $this->base_url.$endpoint;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$this->bearerToken
            ),
        ));

        $json = curl_exec($curl);
        curl_close($curl);
        return json_decode($json);
    }

    




}
