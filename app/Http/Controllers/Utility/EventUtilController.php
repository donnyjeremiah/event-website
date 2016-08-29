<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;

use App\Http\Requests;

class EventUtilController extends Controller
{
    public static function getPosterNo($id)
    {
        $counter = 0;
        for($i=1; $i<=10; $i++) {
            $name = $id . "-event-poster-" . $i . ".jpg"; //<event_id>-event-poster-<no>.jpg
            if (!Storage::disk('poster')->exists($name)) {
                break;
            }
            $counter++;
        }
        return $counter;
    }

    //localhost/event_website/public/user/events/poster/28-event-poster-2.jpg
    public function getPoster($name)
    {
        $img = Image::make(storage_path('app/uploads/poster') . '/' . $name);

        // resize image to 200x200 and keep the aspect ratio
        $img->resize(945, 445, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Fill up the blank spaces with transparent color
        //$img->resizeCanvas(945, 445, 'center', false, array(255, 255, 255, 0));
        $img->resizeCanvas(945, 445, 'center', false, array(19, 19, 19, 0));

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
