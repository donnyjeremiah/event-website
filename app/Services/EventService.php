<?php
namespace App\Services;

use Image;
use Storage;

class EventService
{
    public function saveImageFor($type, $file, $name)
    {
        $img = Image::make($file);
        if($type == 'carousel') {
            // resize image to 945x445 and keep the aspect ratio
            $img->resize(945, 445, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        elseif ($type == 'thumb') {
            $img->resize(100, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // Fill up the blank spaces with transparent color
            $img->resizeCanvas(100, 100, 'center', false, array(255, 255, 255, 0));
        }
        Storage::disk('poster.'.$type)->put($name, $img->stream());
    }
    /*
    public function getPosterNo($id)
    {
        $counter = 0;
        for($i=1; $i<=10; $i++) {
            $name = $id . "-event-poster-" . $i . ".jpg"; //<event_id>-event-poster-<no>.jpg
            if (!Storage::disk('poster.carousel')->exists($name)) {
                break;
            }
            $counter++;
        }
        return $counter;
    }
    */
}
