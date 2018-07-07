<?php

namespace App\Http\Controllers;

use App\Newsfeed;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsfeedsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('promoter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('newsfeeds.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsfeeds.create');
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
            'text' => 'required|max:255',
        ]);

        //create Model
        $newsfeed = new Newsfeed;

        $newsfeed->text = $request->text;

        $newsfeed->save();

        return redirect(route('newsfeeds.index'))->withInfo('News erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Newsfeed $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsfeed $newsfeed)
    {
        return view('newsfeeds.edit', compact('newsfeed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Newsfeed $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsfeed $newsfeed)
    {
        //validation
        $this->validate($request, [
            'text' => 'required|max:255',
        ]);

        $newsfeed->text = $request->text;

        $newsfeed->save();

        return redirect(route('newsfeeds.index'))->withInfo('News erfolgreich editiert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Newsfeed $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsfeed $newsfeed)
    {
        $newsfeed->delete();

        return redirect(route('newsfeeds.index'));
    }
}
