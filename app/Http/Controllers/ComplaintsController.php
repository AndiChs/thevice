<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Group;
use App\Http\Requests\ComplaintRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check())
            $personalComplaints = Complaint::where('complainant_name', '=', Auth::user()->player_name)->orWhere('player_name', '=', Auth::user()->player_name)->limit(10)->get();
        $complaints = Complaint::where('type', '!=', 4)->orderBy('status','asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('app.complaints.index', compact('complaints', 'personalComplaints'));
    }

    public function group($groupId){
        $group = Group::findOrFail($groupId);
        $complaints = Complaint::where('faction_id', '=', $groupId)->where('type','=', 4)->orderBy('status','asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('app.complaints.group', compact('complaints', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($playerName)
    {
        //
        if(Auth::user()->player_name == $playerName)
            return redirect('/');

        $user = User::where('player_name', '=', $playerName)->firstOrFail();

        $complaintTypes = [
            '0'=>'Deathmatch / drive-by',
            '1'=>'Offensive language / insults / dirty words',
            '2'=>'Scam / Scam attempt',
            '3'=>'Other (abuz, comportament non-rp)',
            '4'=>'Faction mistake',
            '5'=>'Admin abuse/mistake',
            '6'=>'Helper abuse/mistake',
            '7'=>'Leader abuse/mistake'
        ];

        if($user->player_team_rank != 7)
            unset($complaintTypes[7]);

        if($user->player_helper == 0)
            unset($complaintTypes[6]);

        if($user->player_admin == 0)
            unset($complaintTypes[5]);

        if($user->player_team == 0 || $user->player_team_rank == 7)
            unset($complaintTypes[4]);

        return view('app.complaints.create', compact('complaintTypes', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintRequest $request, $playerName)
    {
        //
        $input = $request->all();
        $user = User::where('player_name', '=', $playerName)->first();




        $input['player_name'] = $playerName;
        $input['complainant_name'] = Auth::user()->player_name;

        if($input['type'] == 4)
            $input['faction_id'] = User::where('player_name', '=', $playerName)->first()->player_team;

        $complaint = Complaint::create($input);

        $notification['body'] = '<strong>'.Auth::user()->player_name.'</strong> opened a complaint against you, reason:<strong>'.$complaint->getType().'</strong>.';
        $notification['url'] = route('complaint.show', $complaint);

        $user->notifications()->create($notification);

        return redirect()->route('complaint.show', $complaint->id);
    }

    public function storeComment(Request $request, $id){

        $complaint = Complaint::findOrFail($id);
        if($complaint->status == 0) {
            if (Auth::user()->isAdmin() == 1 || $complaint->type == 4 && Auth::user()->player_team_rank > 5 && Auth::user()->player_team == $complaint->faction_id || Auth::user()->player_name == $complaint->player_name || Auth::user()->player_name == $complaint->complainant_name) {
                $comment = $request->all();
                $comment['player_name'] = Auth::user()->player_name;
                $complaint->comments()->create($comment);
            }
        }
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $complaint = Complaint::findOrFail($id);
        $input = $request->all();
        if(isset($input['reason']) && $complaint->status == 0){
            $data['type'] = $input['actionType'];
            $data['complaint'] = $id;
            if($data['type'] != 1 && $data['type'] != 5)
                $data['amount'] = $input['amount'];
            $data['player'] = $complaint->player_name;
            $data['admin'] = Auth::user()->player_name;
            DB::table('panel_actions')
                ->insert($data);


            switch ($data['type']){
                case 1:
                    $comment['body'] =  'Admin '.$data['admin'].' warned player '.$data['player'].', reason:'.$input['reason'].'.';
                    break;
                case 2:
                    $comment['body'] =  'Admin '.$data['admin'].' banned player '.$data['player'].', reason:'.$input['reason'].', for '.$data['amount'].' days.';
                    break;
                case 3:
                    $comment['body'] =  'Admin '.$data['admin'].' muted player '.$data['player'].', reason:'.$input['reason'].', for '.$data['amount'].' minutes.';
                    break;
                case 4:
                    $comment['body'] =  'Admin '.$data['admin'].' jailed player '.$data['player'].', reason:'.$input['reason'].', for '.$data['amount'].' minutes.';
                    break;
                case 5:
                    $comment['body'] =  $data['admin'].' gave a FW to player '.$data['player'].', reason:'.$input['reason'].'.';
                    break;
            }
            $comment['player_name'] = $data['admin'];
            $complaint->comments()->create($comment);
        }



        $complaint->update($input);

        /*=============================================[NOTIFICATIONS]================================================*/
        if($complaint->status == 1) {
            //For user
            $user = User::where('player_name', '=', $complaint->player_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> closed the complaint against you created by <strong>' . htmlspecialchars($complaint->complainant_name) . '</strong>.';
            $notification['url'] = route('complaint.show', $complaint->id);

            $user->notifications()->create($notification);

            //For Complainer
            $complainant = User::where('player_name', '=', $complaint->complainant_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> closed your complaint against <strong>' . htmlspecialchars($complaint->player_name) . '</strong>.';
            $notification['url'] = route('complaint.show', $complaint->id);

            $complainant->notifications()->create($notification);
        }

        return redirect()->back();
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
        $complaint = Complaint::findOrFail($id);
        $user = User::where('player_name', '=', $complaint->player_name)->first();
        $complainant = User::where('player_name', '=', $complaint->complainant_name)->first();

        return view('app.complaints.show', compact('user', 'complaint','complainant'));
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
