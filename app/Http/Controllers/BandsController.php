<?php

namespace App\Http\Controllers;

use App\Band;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class BandsController extends Controller
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
        $bands = Band::orderBy('name')->paginate(config('custom.bands_per_page'));

        return view('bands.index', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bands.create');
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
            'name' => 'required|max:40',
            'description' => 'required|max:500',
            'homepage' => 'required',
            'image' => 'required'
        ]);

        //create Model
        $band = new Band;

        $band->name = $request->name;
        $band->description = $request->description;
        $band->homepage = $request->homepage;
        $band->soundcloud = $request->soundcloud;

        $band->save();

        //resize and move the image(s)
        mkdir(public_path('images/uploads/bands/' . $band->id));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $band->image = $filename;
            $path = public_path('images/uploads/bands/' . $band->id . '/' . $filename);
            Image::make($image->getRealPath())->widen(350)->save($path);

            $band->save();
        }

        //return redirect(route('bands.edit', [$band]))->withInfo('Band erfolgreich erstellt!');
        return redirect(route('bands.index'))->withInfo('Band erfolgreich erstellt!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Band $band
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Band $band)
    {
        return view('bands.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Band $band
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Band $band)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:40',
            'description' => 'required|max:500',
            'homepage' => 'required'
        ]);

        $band->name = $request->name;
        $band->description = $request->description;
        $band->homepage = $request->homepage;
        $band->soundcloud = $request->soundcloud;

        $band->save();

        //resize and move the image(s)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $band->image = $filename;
            $path = public_path('images/uploads/bands/' . $band->id . '/' . $filename);
            Image::make($image->getRealPath())->widen(350)->save($path);
        }

        $band->save();

        //return redirect(route('bands.edit', [$band]))->withInfo('Band erfolgreich geändert!');
        return redirect(route('bands.index'))->withInfo('Band erfolgreich geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Band $band
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Band $band)
    {
        array_map('unlink', glob(public_path('images/uploads/bands/' . $band->id . '/*.*')));
        rmdir(public_path('images/uploads/bands/' . $band->id));

        $band->delete();

        return redirect(route('bands.index'))->withInfo('Band erfolgreich gelöscht!');
    }
}
