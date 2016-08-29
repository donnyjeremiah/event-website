<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// facades
use DB;
use Storage;
use File;
use Session;
// models
use App\EventType;
use App\EventApprovalStatus;
use App\Event;
use App\EventAddress;
// form requests
use App\Http\Requests\CreateEventFormRequest;

class EventController extends Controller
{
    // only accessed by organisers
    //public function __construct()
    //{
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    //}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for visitor, organisor, admin
        // pagination url = '?page=2'
        $events = Event::orderBy('id', 'desc')->paginate(10);
        return view('events.index_organiser', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
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
            return Redirect::to('events.create')->withErrors( $e->getErrors() );
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

            // upload poster
            $files = $request->file('poster');
            if(!empty($files)) {
                $counter = 0;
                foreach($files as $file) {
                    $name = $event->id . "-event-poster-" . ++$counter . ".jpg"; //<event_id>_poster_<no>.jpg
                    Storage::disk('poster')->put($name, File::get($file)); // instead of File:get, can use file_get_contents()
                }
            }
        }
        catch(ValidationException $e) {
            DB::rollback();
            return Redirect::to('events.create')->withErrors( $e->getErrors() );
        }
        catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();

        // redirect
        // return redirect()->route('events.show', $event->id());
        // return redirect()->route('events.show')->with(['message' => $message]);
        // if($request->user()->events()->save($event)) $message = 'success';
        //return redirect()->route('events.create');
        // avail only for the current request.
        // For permanent sessions, Session::put()
        Session::flash('success', 'The event was successfully created.');
        return redirect()->route('events.show', ['id' => $event->id]);
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
            return view('events.show_organiser', ['event' => $event]);
            //return view('events.show_visitor', ['event' => $event]);
        }
        else {
            //Session::flash('error', 'Event coudn\'t be found.');
            //return view('events.show', ['event' => null, 'is_error' => true]); //ERROR
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit_organiser', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
