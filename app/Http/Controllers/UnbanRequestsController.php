<?php

namespace App\Http\Controllers;

use App\Ban;
use App\Http\Requests\RequestUnban;
use App\UnbanRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnbanRequestsController extends Controller
{
    //
    public function index(){
        if(Auth::user()->player_admin > 2)
            $unbanRequests = UnbanRequest::orderBy('status', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        else
            $unbanRequests = UnbanRequest::where('player_name', '=', Auth::user()->player_name)
                ->orderBy('status', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(10);


        return view('app.unban.index', compact('unbanRequests'));
    }
    public function store(RequestUnban $request){
        $input = $request->all();
        $input['player_name'] = Auth::user()->player_name;
        $id = UnbanRequest::create($input);
        return redirect()->route('unban.show',$id);
    }

    public function create(){
        $ban = Ban::where('player_name', '=', Auth::user()->player_name)->first();
        return view('app.unban.create', compact('ban'));
    }

    public function storeComment(Request $request, $ticketId){

        $unbanRequest = UnbanRequest::findOrFail($ticketId);

        if(Auth::user()->isAdmin() == 0 && Auth::user()->player_name !== $unbanRequest->player_name)
            return redirect('/');

        if($unbanRequest->status == 1)
            return redirect()->back();

        $data = $request->all();
        $data['player_name'] = Auth::user()->player_name;
        $unbanRequest->comments()->create($data);
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $unbanRequest = UnbanRequest::findOrFail($id);
        $unbanRequest->update($request->all());
        $data = $request->all();

        //Add the comment with the punishment
        if(isset($data['unban'])){
            $comment['body'] = 'Admin '.Auth::user()->player_name.' unbanned player '.$unbanRequest->player_name.'.';

            Ban::where('player_name', '=', $unbanRequest->player_name)->delete();

        }
        else{
            $comment['body'] = 'Admin '.Auth::user()->player_name.' closed the unban request.';
        }
        $comment['player_name'] = Auth::user()->player_name;

        $unbanRequest->comments()->create($comment);

        // Notifications
        if($unbanRequest->status == 1){
            $user = User::where('player_name', '=', $unbanRequest->player_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> closed your <strong>Unban Request</strong>.';
            $notification['url'] = route('unban.show', $unbanRequest->id);

            $user->notifications()->create($notification);
        }

        return redirect()->route('unban.show', $id);
    }

    public function show($id){
        $unbanRequest = UnbanRequest::findOrFail($id);

        if(Auth::user()->player_name != $unbanRequest->player_name && Auth::user()->player_admin < 1)
            return redirect('/');

        $user = User::where('player_name', '=', $unbanRequest->player_name)->first();

        $ban = Ban::where('player_name', '=', $unbanRequest->player_name)->first();

        return view('app.unban.show', compact('unbanRequest', 'user', 'ban'));
    }
}
