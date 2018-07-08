<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationMail;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ApplicationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('booker')->except(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::orderBy('created_at','desc')->get();
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applications.create');
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
            'name' => 'required|max:128',
            'mail' => 'required|max:50',
            'genre' => 'required',
            'text' => 'required|max:2500',
            'link1' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'link2' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'link3' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);

        //create Model
        $application = new Application;

        $application->name = $request->name;
        $application->mail = $request->mail;
        $application->genre = $request->genre;
        $application->text = $request->text;
        $application->link1 = $request->link1;
        $application->link2 = $request->link2;
        $application->link3 = $request->link3;
        $application->save();

        return redirect(route('apply'))->withInfo('Vielen Dank für Ihre Anfrage!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
        $this->send();
        return redirect(route('applications.index'))->withInfo('Bewerbung erfolgreich gelöscht!');
    }

    /**
     * Sends an automated E-Mail of this resource.
     *
     * @param  Application $application
     * @return \Illuminate\Http\Response
     */
    public function send(Application $application) {
        switch ($application->genre) {
            case 'metal':
                $recipient = 'metalgigs@hexenhaus-metal.de';
                break;
            case 'stoner':
            case 'psy':
                $recipient = 'goodoldshit@hexenhaus-metal.de';
                break;
            default:
                $recipient = 'Puddy@hexenhaus-metal.de';
        }
        Mail::to($recipient)->send(new ApplicationMail($application));

        return redirect(route('applications.show', $application))->withInfo('Bewerbung wurde zugestellt.');
    }
}
