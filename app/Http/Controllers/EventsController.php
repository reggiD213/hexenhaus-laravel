<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class EventsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'indexBygone', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::upcomming()->orderBy('datetime')->paginate(config('custom.events_per_page'));

        return view('events.index', compact('events'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBygone()
    {
        $events = Event::bygone()->orderBy('datetime', 'desc')->paginate(config('custom.events_per_page'));

        return view('events.index', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'desc_short' => 'required|max:500',
            'desc_long' => 'required',
            'date' => 'date',
            'time' => 'date_format:H:i',
        ]);

        //create Model
        $event = new Event;

        $event->name = $request->name;
        $event->desc_short = $request->desc_short;
        $event->desc_long = clean($request->desc_long);
        $event->price = $request->price;
        $event->datetime = $request->date . ' ' . $request->time . ':00';

        $event->save();

        //resize and move the image(s)
        mkdir(public_path('images/uploads/events/' . $event->id));
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $time = time();


            $filename = $time . '_' . $image->getClientOriginalName();
            $thumbnail = $time . '_thumb_' . $image->getClientOriginalName();

            $event->image = $filename;

            $path = public_path('images/uploads/events/' . $event->id . '/' . $filename);
            $thumbpath = public_path('images/uploads/events/' . $event->id . '/' . $thumbnail);

            $intervention = Image::make($image->getRealPath())->widen(800)->save($path);
            Image::make($image->getRealPath())->widen(223)->save($thumbpath);

            $event->image_height = $intervention->height();
            $event->image_width = $intervention->width();
            $event->save();
        }

        return redirect(route('events.index'))->withInfo('Veranstaltung erfolgreich erstellt!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'desc_short' => 'required|max:500',
            'desc_long' => 'required',
            'date' => 'date',
            'time' => 'date_format:H:i',
        ]);
        $event->name = $request->name;
        $event->desc_short = $request->desc_short;
        $event->desc_long = clean($request->desc_long);
        $event->price = $request->price;
        $event->guests = $request->guests;
        $event->datetime = $request->date . ' ' . $request->time . ':00';

        $event->save();

        //resize and move the image(s)
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $time = time();


            $filename = $time . '_' . $image->getClientOriginalName();
            $thumbnail = $time . '_thumb_' . $image->getClientOriginalName();

            $event->image = $filename;

            $path = public_path('images/uploads/events/' . $event->id . '/' . $filename);
            $thumbpath = public_path('images/uploads/events/' . $event->id . '/' . $thumbnail);

            $intervention = Image::make($image->getRealPath())->widen(800)->save($path);
            Image::make($image->getRealPath())->widen(223)->save($thumbpath);

            $event->image_height = $intervention->height();
            $event->image_width = $intervention->width();
            $event->save();
        }

        //return redirect(route('events.edit', [$event]))->withInfo('Veranstaltung erfolgreich geändert!');
        return redirect(route('events.index'))->withInfo('Veranstaltung erfolgreich geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        array_map('unlink', glob(public_path('images/uploads/events/' . $event->id . '/*.*')));
        rmdir(public_path('images/uploads/events/' . $event->id));

        $event->delete();

        return redirect(route('events.index'))->withInfo('Veranstaltung erfolgreich gelöscht!');
    }
}
