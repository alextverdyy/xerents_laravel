<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

use App\Quotation;
use Auth;

class EventsManagerController extends Controller
{
    public function index(){
        $client = new Client([
            'base_uri' => 'http://api.eventful.com/rest/',
            'timeout' => 20.0,
        ]);

        $coordClient = new Client([
            'base_uri' => 'http://ip-api.com/json/',
            'timeout' => 20.0
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
            }else{
                $like = Like::find($createdLike);
                //print_r($like);
                $like->delete();
            }
        }else{
            echo "Usuario no encontrado";
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

}
