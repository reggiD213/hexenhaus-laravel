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
        $pic->gallery_id = $request->gallery_id;

        $path = public_path('images/uploads/galleries/' . $pic->gallery_id . '/' .  $filename);
        $thumbpath = public_path('images/uploads/galleries/' . $pic->gallery_id . '/' . $thumbnail);

        $intervention = Image::make(
            $image->getRealPath())->widen(1920, function ($constraint) {
            $constraint->upsize();
        })->save($path);
        Image::make($image->getRealPath())->widen(227)->save($thumbpath);

        $pic->height = $intervention->height();
        $pic->width = $intervention->width();
        $pic->save();

        return response()->json([
            'bla' => $request->all(),
            'success' => true
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Pic $pic
     * @return \Illuminate\Http\Response
     */
    public function edit(Pic $pic)
    {
        return view('pics.edit', compact('pic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pic $pic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pic $pic)
    {

        $pic->gallery_id = $request->gallery_id ? $request->gallery_id : 1;

        if ($request->hasFile('image')) {
            //resize and move the image(s)
            $image = $request->file('image');
            $time = time();

            $filename = $time . '_' . $image->getClientOriginalName();
            $thumbnail = $time . '_thumb_' . $image->getClientOriginalName();

            $pic->filename = $filename;

            $path = public_path('images/uploads/gallery/' . $filename);
            $thumbpath = public_path('images/uploads/gallery/' . $thumbnail);

            $intervention = Image::make(
                $image->getRealPath())->widen(1920, function ($constraint) {
                    $constraint->upsize();
                })->save($path);
            Image::make($image->getRealPath())->widen(227)->save($thumbpath);

            $pic->height = $intervention->height();
            $pic->width = $intervention->width();
        }

        $pic->save();

        return redirect(route('pics.index'))->withInfo('Bild erfolgreich geändert!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pic $pic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pic $pic)
    {
        dd($pic->id);
        $pic->delete();
        unlink(public_path('images/uploads/galleries/' . $pic->gallery . '/' . $pic->thumbnail()));
        unlink(public_path('images/uploads/galleries/' . $pic->gallery . '/' . $pic->filename));
        dd('jup');


        return redirect(route('pics.index'))->withInfo('Bild erfolgreich gelöscht!');
    }

}
