<?php

namespace App\Http\Controllers;

use App\Gallery;
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
        /*
        $galleries = Gallery::with(['event' => function ($query) { //TODO: verify if this works (I doubt it.)
            $query->orderBy('datetime', 'desc');
        }], 'pics')->paginate(config('custom.galleries_per_page'));
        */
        $galleries = Gallery::paginate(config('custom.galleries_per_page'));
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::bygone()->doesntHave('gallery')->orderBy('datetime', 'desc')->get();
        

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

        //create Model
        $gallery = new Gallery;

        $gallery->event_id = $request->event;
        $event = Event::where('id', $gallery->event_id)->first();
        //dd($event);
        $gallery->slug = $event->slug;
        $gallery->save();

        mkdir(public_path('images/uploads/galleries/' . $gallery->id));

        return redirect(route('galleries.index'))->withInfo('Galerie erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }


    public function getAjax(Gallery $gallery)
    {
        return $gallery;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        array_map('unlink', glob(public_path('images/uploads/galleries/' . $gallery->id . '/*.*')));
        rmdir(public_path('images/uploads/galleries/' . $gallery->id));

        $gallery->delete();

        return redirect(route('galleries.index'))->withInfo('Galerie erfolgreich gelöscht!');
    }
}
