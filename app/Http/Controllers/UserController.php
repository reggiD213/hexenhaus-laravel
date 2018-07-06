<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'privileges' => 'required|integer|min:0|max:127',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->privileges = $request->privileges;
        $user->save();

        return redirect(route('members.index'))->withInfo('User erfolgreich geändert!');
    }
}