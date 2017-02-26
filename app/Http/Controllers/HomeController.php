<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->id == 1) {
            return view('home', [
                'friend' => User::find(2),
            ]);
        }
        return view('home', [
            'friend' => User::find(1),
        ]);
    }
}
