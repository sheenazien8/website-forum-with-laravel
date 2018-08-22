<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
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
        return view('home');
    }
    public function profile($id = null)
    {
        if ($id == null) {
            /*ini hanya untuk profile yang sudah login*/
            $user = User::find(Auth::user()->id);
        }else {
            $user = User::find($id);
        }
        
        return view('profile',compact('user'));
    }
}
