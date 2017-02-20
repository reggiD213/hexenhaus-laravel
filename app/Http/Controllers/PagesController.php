<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function apply()
    {
        return view('pages.apply');
    }
    public function pics()
    {
        return view('pages.pics');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function impressum()
    {
        return view('pages.impressum');
    }
    public function members()
    {
        return view('pages.members');
    }
}
