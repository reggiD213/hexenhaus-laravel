<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class GalleriesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->only(['store', 'create', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::bygone()->where('hasPics','=','1')->orderBy('datetime', 'desc')->get();

        return view('galleries.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::bygone()->where('hasPics','=','0')->orderBy('datetime', 'desc')->get();
        
        return view('galleries.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'event' => 'required|exists:events,id'
        ]);

        //get Model
        $event = Event::where('id', $request->event)->first();
        $event->hasPics = 1;
        $event->save();

        mkdir(public_path('images/uploads/events/' . $event->date() . '/gallery'));

        return redirect(route('galleries.index'))->withInfo('Galerie erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('galleries.show', compact('event'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        array_map('unlink', glob(public_path('images/uploads/events/' . $event->date() . '/gallery/*.*')));
        rmdir(public_path('images/uploads/events/' . $event->date() . '/gallery'));

        $event->hasPics = 0;
        $event->save();

        return redirect(route('galleries.index'))->withInfo('Galerie erfolgreich gelöscht!');
    }
}
