<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function changeUserPassword(Request $request){

        $input = $request->all();

        if(Hash::check($input['currentPassword'], Auth::user()->player_password)){
            if($input['newPassword'] == $input['newPassword2']){
                Auth::user()->update(['player_password'=>bcrypt($input['newPassword'])]);
                Session::flash('success_change_password', 'You successfully changed your password.');
            }
            else{
                Session::flash('error_change_password', 'The passwords didn\'t match.');
            }
        }
        else{
            Session::flash('error_change_password', 'You inserted a wrong password.');
        }
        return redirect()->back();
    }
    public function notifications(){
        $notifications = Notification::where('player_id', '=', Auth::user()->player_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('app.notifications', compact('notifications'));
    }
}
