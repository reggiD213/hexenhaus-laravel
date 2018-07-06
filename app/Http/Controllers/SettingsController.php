<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Setting $setting)
    {
        //validation
        $this->validate($request, [
            'value' => 'required',
        ]);

        $setting->value = $request->value;
        $setting->save();

        return redirect(route('members.index'))->withInfo('Einstellung erfolgreich geändert!');
    }
}
