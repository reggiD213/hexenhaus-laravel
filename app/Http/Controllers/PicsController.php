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
        $this->middleware('admin')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pics = Pic::all();

        return view('pics.index', compact('pics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pics.create');
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
            'name' => 'max:30',
            'image' => 'required'
        ]);

        //create Model
        $pic = new Pic;

        $pic->name = $request->name ? $request->name : null;

        //resize and move the image(s)
        $image = $request->file('image');
        $time = time();

        $filename = $time . '_' . $image->getClientOriginalName();
        $thumbnail = $time . '_thumb_' . $image->getClientOriginalName();

        $pic->filename = $filename;

        $path = public_path('images/uploads/gallery/' . $filename);
        $thumbpath = public_path('images/uploads/gallery/' . $thumbnail);

        Image::make($image->getRealPath())->widen(800)->save($path);
        Image::make($image->getRealPath())->widen(227)->save($thumbpath);

        $pic->save();

        return redirect(route('pics.index'))->withInfo('Bild erfolgreich hochgeladen!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pic $pic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pic $pic)
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
    public function update(Request $request, Pic $pic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pic $pic)
    {
        //
    }

}
