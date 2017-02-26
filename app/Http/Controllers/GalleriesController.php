<?php

namespace App\Http\Controllers;

use App\Gallery;
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
        $this->middleware('admin')->except(['index', 'show']);
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
        $galleries = Gallery::all();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
