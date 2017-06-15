<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Like;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Log;

use Cartalyst\Alerts\Native\Facades\Alert;
use App\Quotation;
use Auth;

class EventsManagerController extends Controller
{
    public function index(){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 60.0,
        ]);

        $coordClient = new Client([
            'base_uri' => 'http://ip-api.com/json/',
            'timeout' => 60.0
        ]);
        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $coords = $coordClient->request('GET', "$ip");
    //print_r($coords->getBody()->getContents());
        $coordsJson = json_decode($coords->getBody()->getContents());
        //print_r($coordsJson);
        $response = $client->request('GET','events/search?app_key=rCR5P3ZZGndrHvpR&location='.$coordsJson->lat.','.$coordsJson->lon.'&within=20&image_sizes=blackborder250,large&include=description&page_size=9');

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //print_r($elements["events"]["event"][0]["@attributes"]["id"]);
        return view("index")->with("events", $elements["events"]["event"]);
        //print_r($elements);
    }
    public function event($id){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);
        // TODO: Add location
        $response = $client->request( 'GET','events/get?app_key=rCR5P3ZZGndrHvpR&image_sizes=large&id='.$id);

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //print_r($elements["events"]["event"][0]["@attributes"]["id"]);
        return view('event')->with('event', $elements);
    }
    public function favorite($id) {

        if (!is_null(Auth::id())) {
            $createdLike = DB::table('likes')->where('event_id','=',$id)->where('user_id','=',Auth::id())->value('id');
            if (is_null($createdLike)) {
                $arr = array(
                    'event_id' => $id,
                    'user_id' => Auth::id()
                );
                $like = Like::create($arr);
                echo "correcto";
            }else{
                $like = Like::find($createdLike);
                //print_r($like);
                $like->delete();
                echo "correcto";
            }
        }else{
            echo "conectado";
        }
    }
    public function favoriteList(){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);
        // TODO: Add location
        $arrElements = array();

        $userFavorites = json_decode(DB::table('likes')->where('user_id','=',Auth::id())->get(), true);
        foreach ($userFavorites as $element) {
            $response = $client->request( 'GET','events/get?app_key=rCR5P3ZZGndrHvpR&image_sizes=large&id='.$element['event_id']);
            $xml = new \SimpleXMLElement($response->getBody()->getContents());
            $json = json_encode($xml,JSON_FORCE_OBJECT);
            $elements = json_decode($json, true);
            array_push($arrElements,$elements);

        }


        return view("favorites")->with("events",$arrElements);
        /*
        $response = $client->request( 'GET','events/get?app_key=rCR5P3ZZGndrHvpR&image_sizes=large&id='.$id);

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //print_r($elements["events"]["event"][0]["@attributes"]["id"]);
        return view('event')->with('event', $elements);
        */
    }
    public function isFavorited($id) {
        if (!is_null(Auth::id())) {
            $createdLike = DB::table('likes')->where('event_id','=',$id)->where('user_id','=',Auth::id())->value('id');
            if (is_null($createdLike)) {
                echo "true";
            }else{
                echo "false";
            }
        }else{
            echo "conectado";
        }
    }
    public function autocompletar()
    {
        $term = Str::lower(Input::get('term'));
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);
        // TODO: Add location
        $response = $client->request( 'GET','events/search?page_size=9&app_key=rCR5P3ZZGndrHvpR&keywords='.$term);

        $xml = new \SimpleXMLElement($response->getBody()->getContents());

        $json = json_encode($xml,JSON_FORCE_OBJECT);
        $elements = json_decode($json, true);
        //return print_r($elements);
        if ($elements["total_items"] == 0){
            return view("notfound");
        }
        return view("index")->with("events", $elements["events"]["event"]);
    }

}
