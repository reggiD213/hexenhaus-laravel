<?php

namespace App\Http\Controllers;

use App\Member;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('name')->get();
        if (Auth::user()->admin()) {
            $settings = Setting::all();
            $users = User::all();
        } else {
            $settings = null;
            $users = null;
        }

        return view('members.index', compact('members','settings','users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'firstname' => 'required|max:255,alpha',
            'lastname' => 'required|max:255,alpha',
            'name' => 'max:255,alpha',
            'email' => 'required|max:500|email',
            'phone' => 'required|numeric',
            'street' => 'required|max:255,alpha',
            'housenumber' => 'required|max:5',
            'zip' => 'required|numeric|between:0,99999',
            'city' => 'required|max:255,alpha',
            'birthday' => 'required|date',
        ]);

        //create Model
        $member = new Member;
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->street = $request->street;
        $member->housenumber = $request->housenumber;
        $member->zip = $request->zip;
        $member->city = $request->city;
        $member->birthday = $request->birthday;
        $member->save();

        return redirect(route('members.index'))->withInfo('Member erfolgreich erstellt!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Member $member
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Member $member)
    {
        //validation
        $this->validate($request, [
            'firstname' => 'required|max:255,alpha',
            'lastname' => 'required|max:255,alpha',
            'name' => 'max:255,alpha',
            'email' => 'required|max:500|email',
            'phone' => 'required|numeric',
            'street' => 'required|max:255,alpha',
            'housenumber' => 'required|max:5',
            'zip' => 'required|numeric|between:0,99999',
            'city' => 'required|max:255,alpha',
            'birthday' => 'required|date',
        ]);

        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->street = $request->street;
        $member->housenumber = $request->housenumber;
        $member->zip = $request->zip;
        $member->city = $request->city;
        $member->birthday = $request->birthday;
        $member->save();

        return redirect(route('members.index'))->withInfo('Member erfolgreich geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect(route('members.index'))->withInfo('Member erfolgreich gelöscht!');
    }
}
