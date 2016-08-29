<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

// facades
use Session;

// models
use App\Event;

// form requests
use App\Http\Requests\CreateEventFormRequest;

// dependencies
use App\Services\EventService;

class ApiController extends Controller
{
    public function __construct(/* MapService $mapService */)
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        //$this->eventService = $eventService; // NEED TO REGISTER SERVICE
    }

    /**
     * Display a listing of the resource.
     *
     * @return JSON
     */
    public function getEventsJSON(Request $request)
    {
        // , $ne, $sw
        if(!$request->ajax()) {
            //return error(403);
        }

        // get events within these bounds northeast and southwest
        $events = DB::table('events_addresses')->select('latitude', 'longitude')->get();

        // output places as JSON (pretty-printed for debugging convenience)
        header("Content-type: application/json");
        print(json_encode($rows, JSON_PRETTY_PRINT));
    }

   /**
    * https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY
    * https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
    * &components=country:IN
    */
    public function search($address) {
        $key = 'key=AIzaSyCKnxu-Hgws5rNSloauYgiIRKq6AUUKWoY';
        $address = 'address='.$address;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json\?'.$address.'&region=in&'.$key;
        $geocode = file_get_contents($url);
        $output = json_decode($geocode);

        $lat = $output->results[0]->geometry->location->lat;
        $lng = $output->results[0]->geometry->location->lng;

        // output places as JSON (pretty-printed for debugging convenience)
        header("Content-type: application/json");
        print(json_encode($rows, JSON_PRETTY_PRINT));
    }

}
