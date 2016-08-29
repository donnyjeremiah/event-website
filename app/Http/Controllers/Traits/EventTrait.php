<?php

namespace App\Http\Controllers\Traits;

use Image;

trait EventTrait
{
    //localhost/event_website/public/user/events/poster/28-event-poster-2.jpg
    public function getPosterForCarousel($name) // use type too
    {
        $img = Image::make(storage_path('app/public/poster/carousel/') . $name);

        // resize image to 200x200 and keep the aspect ratio
        // width is same, height is adjusted to maintain aspect ration
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Fill up the blank spaces with transparent color
        $img->resizeCanvas(100, 100, 'center', false, array(255, 255, 255, 0));
        //$img->resizeCanvas(100, 100, 'center', false, array(19, 19, 19, 0));

        return $img->response('jpg');
    }

    /*
    public function sort(Request $request)
    {
        if(empty($request->field) || empty($request->order)) {
            return null; // ERROR
        }

        $events = Event::orderBy($field, $order)->paginate(10); // pagination url = '?page=2'
        return view('visitor.events.index', ['events' => $events]);
    }

    public function filter(Request $request) // city, type, organiser [, pincode]
    {
        if(empty($request->field)) {
            return null; // ERROR
        }
    }
    */
}
