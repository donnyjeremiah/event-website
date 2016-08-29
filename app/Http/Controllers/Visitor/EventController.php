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

class EventController extends Controller
{
    public function __construct(EventService $eventService)
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->eventService = $eventService;  // usage: $this->eventService->someMethod()
    }

    // traits
    use \App\Http\Controllers\Traits\EventTrait;

    /**
     * Displays up-coming events from a city (default: Chennai)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = $request->city?$request->city:'Chennai';
        $events = Event::join('events_addresses', function ($join) use ($city) {
            $join->on('events.id', '=', 'events_addresses.event_id')
                 ->where('events.date_start', '>=', \Carbon\Carbon::now()->format('Y-m-d'))
                 ->where('events_addresses.city', '=', $city);
        })
        ->orderBy('events.date_start', 'desc')
        ->paginate(10);
        // EDIT: only Approved
        return view('visitor.events.index', ['events' => $events]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if(!empty($event)) {
            return view('visitor.events.show', ['event' => $event]);
        }
        else {
            //Session::flash('error', 'Event coudn\'t be found.');
            //return view('events.show', ['event' => null, 'is_error' => true]); //ERROR
        }
    }
}
