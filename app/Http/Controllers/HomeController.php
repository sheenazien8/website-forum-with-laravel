<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Notification;
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

    public function getNotif()
    {
        $user = Auth::user();
        $notif_model = new Notification;
        $notifications = Notification::with('quote')->where('user_id', $user->id)->orderBy('id','desc')->get();
        return view('notification', compact('notifications', 'notif_model', 'user'));
    }
}
