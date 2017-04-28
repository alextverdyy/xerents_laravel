<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EventsManagerController extends Controller
{
    public function index(){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);

        $response = $client->request('GET','events/search?app_key=rCR5P3ZZGndrHvpR&keywords=sevilla&image_sizes=blackborder250,large');

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //print_r($elements["events"]["event"][0]["@attributes"]["id"]);
        return view("index")->with("events", $elements["events"]["event"]);
    }
    public function event($id){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);
        // TODO: Add location
        $response = $client->request('GET','events/get?app_key=rCR5P3ZZGndrHvpR&image_sizes=large&id='.$id);

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //print_r($elements["events"]["event"][0]["@attributes"]["id"]);
        print_r($elements);
    }
}
