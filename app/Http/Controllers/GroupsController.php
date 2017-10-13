<?php

namespace App\Http\Controllers;

use App\Group;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class GroupsController extends Controller
{
    //

    public function index(){
        $groups = Group::all();
        return view('app.groups.index', compact('groups'));
    }

    public function members($groupId){
        $group = Group::findOrFail($groupId);
        $members = User::where('player_team', '=', $groupId)->orderBy('player_team_rank', 'desc')->orderBy('player_team_days', 'desc')->get();

        return view('app.groups.members', compact('members', 'groupId', 'group'));
    }

    public function logs($groupId){
        $group = Group::findOrFail($groupId);
        $logs = DB::table('log_team')
            ->where('log_faction', '=', $groupId)->paginate(40);
        return view('app.groups.logs', compact('logs', 'group'));
    }

    public function panel(){
        $questions = Question::findOrFail(Auth::user()->player_team);

        $question = json_decode($questions->questions, true);

        $group = $questions->group;

        return view('app.groups.panel', compact('question', 'group'));

    }

    public function updateQuestions(Request $request, $id){
        $group = Question::findOrFail($id);

        $input = [];

        $data = $request->all();


        foreach($data as $k=>$po) {
            if($k[0] !== 'q' || !strlen($po))
                continue;
            $input[] = $po;
        }

        $group->update(['questions' => json_encode($input)]);
        return redirect()->back();
    }
    public function updateApplications(Request $request, $id){
        $group = Question::findOrFail($id)->group;
        $group->update($request->all());

        return redirect()->back();
    }
}
