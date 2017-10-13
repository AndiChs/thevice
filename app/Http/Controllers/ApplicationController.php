<?php

namespace App\Http\Controllers;

use App\Application;
use App\Group;
use App\Http\Requests\RequestApplication;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($groupId)
    {
        //
        $group = Group::findOrFail($groupId);
        $applications = Application::where('group_id', '=', $groupId)->orderBy('status', 'desc')->limit(100)->get();


        return view('app.applications.index', compact('applications', 'group'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($groupId)
    {
        //
        $question = Question::findOrFail($groupId);
        $group = $question->group;

        if($group->group_Applications == 0)
            return redirect('/');
        $user = Auth::user();

        if($user->player_team > 0)
            return redirect('/');

        if($user->player_level < $group->group_Level)
            return redirect('/');


        $questions = json_decode($question->questions, true);



        $logs = DB::table('log_team_player')
            ->where('player_name', '=', $user->player_name)->get();

        return view('app.applications.create', compact('questions','group','logs','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $groupId)
    {

        $input = $request->all();
        $body = [];
        foreach ($input as $i=>$data){

            if($i[0] == 'a'  || $i[0] == 'q'){
                $body[] = $data;
            }

        }
        $query['body'] = json_encode($body);

        $query['status'] = 0;

        $query['group_id'] = $groupId;

        $query['player_name'] = $input['player_name'];

        if(Application::where('player_name', '=', $query['player_name'])->whereBetween('status', [0, 1])->count() > 0){
            Session::flash('error_create_application', 'You already have a pending application.');
            return redirect(route('application.create', $groupId));
        }

        $application = Application::create($query);

        return redirect()->route('application.show', $application->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $application = Application::findOrFail($id);

        $logs = DB::table('log_team_player')
            ->where('player_name', '=', $application->player_name)->get();

        $user = User::where('player_name', '=', $application->player_name)->first();

        $body = json_decode($application->body, true);

        return view('app.applications.show', compact('application', 'user', 'logs', 'body'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $application = Application::findOrFail($id);

        $status = $request->all();

        $application->update($status);

        if($application->status == -1){
            $user = User::where('player_name', '=', $application->player_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> rejected your application for <strong>' . htmlspecialchars($application->group->group_Name) . '</strong>.';
            $notification['url'] = route('application.show', $application->id);

            $user->notifications()->create($notification);
        }
        else if($application->status == 1){
            $user = User::where('player_name', '=', $application->player_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> accepted your application for <strong>' . htmlspecialchars($application->group->group_Name) . '</strong>.';
            $notification['url'] = route('application.show', $application->id);

            $user->notifications()->create($notification);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
