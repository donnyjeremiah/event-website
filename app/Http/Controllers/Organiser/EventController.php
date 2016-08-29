<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

// facades
use DB;
use File;
use Session;

// models
use App\EventType;
use App\EventApprovalStatus;
use App\Event;
use App\EventAddress;

// form requests
use App\Http\Requests\CreateEventFormRequest;

// dependencies
use App\Services\EventService;

class EventController extends Controller
{
    public function __construct(EventService $eventService)
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->eventService = $eventService; // usage: $this->eventService->someMethod()
    }

    // traits
    use \App\Http\Controllers\Traits\EventTrait;

    /**
     * Displays events of the Organiser
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pagination url = '?page=2'
        $events = Event::orderBy('id', 'desc')->paginate(10);
        // EDIT: Get ONLY events by THIS organiser
        return view('organiser.events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organiser.events.create');
    }

    /**
     * Stores a newly created event in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $event = new Event();
            $event->user_id = "1"; // Auth::user() or $request->user()->id
            $event->name = $request->name;
            $event->date_start = $request->date_start; // mutator
            $event->date_end = empty($request->date_end)?null:$request->date_end;
            $event->time = $request->time;
            $event->poster_no = count($request->file('poster'));
            $event->description = $request->description;
            $event->type_id = EventType::where('name', $request->type)->value('id');
            $event->status_id = EventApprovalStatus::where('name', 'Pending')->value('id');
            $event->save();
        }
        catch(ValidationException $e) {
            DB::rollback();
            return Redirect::to('organiser.events.create')->withErrors( $e->getErrors() );
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }
        try {
            $address = new EventAddress();
            $address->event_id = $event->id;
            $address->line_1 = $request->line_1;
            $address->line_2 = $request->line_2;
            $address->landmark = $request->landmark;
            $address->zip = $request->zip;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->latitude = $request->latitude;
            $address->longitude = $request->longitude;
            $address->save();

            // Image Intervention
            if($request->hasFile('poster')) {
                $files = $request->file('poster');
                $counter = 1;
                foreach($files as $file) {
                    $name = $event->id . "-event-poster-" . $counter++ . ".jpg"; //<event_id>_poster_<no>.jpg
                    $this->eventService->saveImageFor('carousel', $file, $name);
                    $this->eventService->saveImageFor('thumb', $file, $name);
                }
            }
        }
        catch(ValidationException $e) {
            DB::rollback();
            return Redirect::to('organiser.events.create')->withErrors($e->getErrors());
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        // redirect
        // avail only for the current request.
        // For permanent sessions, Session::put()
        Session::flash('success', 'The event was successfully created.');
        return redirect()->route('organiser::events.show', ['id' => $event->id]);
    }

    /**
     * Display the details of the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if(!empty($event)) {
            return view('organiser.events.show', ['event' => $event]);
        }
        else {
            //Session::flash('error', 'Event coudn\'t be found.');
            //return view('events.show', ['event' => null, 'is_error' => true]); //ERROR
        }
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('organiser.events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        $event = Event::find($id);
        $event->name = $request->name;
        $event->save();

        Session::flash('success', 'The event was successfully edited.');
        return redirect()->route('events.show', ['id' => $event->id]);
        */
    }

    /**
     * Remove the specified event from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $event = Event::find($id);
        $event->delete();
        Session::flash('success', 'The event was successfully deleted.');
        return redirect()->route('events.index');
        */
    }
}
