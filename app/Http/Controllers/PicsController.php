<?php

namespace App\Http\Controllers;

use App\Pic;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class PicsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('uploader');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create Model
        $pic = new Pic;

        //resize and move the image(s)
        $image = $request->file('qqfile');
        $time = time();

        $filename = $time . '_' . $image->getClientOriginalName();
        $thumbnail = $time . '_thumb_' . $image->getClientOriginalName();

        $pic->filename = $filename;
        $pic->event_id = $request->event_id;

        $path = public_path('images/uploads/events/' . $request->event_date . '/' . 'gallery/' .  $filename);
        $thumbpath = public_path('images/uploads/events/' . $request->event_date . '/' . 'gallery/' . $thumbnail);



        $intervention = Image::make(
            $image->getRealPath())->widen(1920, function ($constraint) {
            $constraint->upsize();
        })->save($path);
        Image::make($image->getRealPath())->widen(227)->save($thumbpath);

        $pic->height = $intervention->height();
        $pic->width = $intervention->width();
        $pic->save();

        
        return response()->json([
            'success' => true
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pic $pic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pic $pic)
    {
        $pic->delete();
        unlink(public_path('images/uploads/events/' . $pic->event->date() . '/gallery/' . $pic->thumbnail()));
        unlink(public_path('images/uploads/events/' . $pic->event->date() . '/gallery/' . $pic->filename));



        return redirect(route('galleries.show', $pic->event))->withInfo('Bild erfolgreich gelöscht!');
    }

}
