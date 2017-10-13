<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->isAdmin()){
            $tickets = Ticket::orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        }
        else{
            $tickets = Ticket::where('player_name', '=', Auth::user()->player_name)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('app.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ticketTypes = [
            '0'=>'General ticket',
            '1'=>'Problems with the account',
            '2'=>'Problems with a payment',
        ];
        return view('app.tickets.create', compact('ticketTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $input['player_name'] = Auth::user()->player_name;
        $ticket = Ticket::create($input);
        return redirect()->route('ticket.show', $ticket->id);
    }

    public function storeComment(Request $request, $ticketId){

        $ticket = Ticket::findOrFail($ticketId);

        if(Auth::user()->isAdmin() == 0 && Auth::user()->player_name !== $ticket->player_name)
            return redirect('/');

        if($ticket->status == 1)
            return redirect()->back();

        $data = $request->all();
        $data['player_name'] = Auth::user()->player_name;
        $ticket->comments()->create($data);
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
        $ticket = Ticket::findOrFail($id);
        $user = User::where('player_name', '=', $ticket->player_name)->first();

        if(Auth::user()->isAdmin() == 0 && Auth::user()->player_name !== $ticket->player_name)
            return redirect('/');

        return view('app.tickets.show', compact('ticket','user'));
    }

    /**
     * Update the ticket status
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



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

    public function update(Request $request, $id){
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        if($ticket->status == 1){
            $user = User::where('player_name', '=', $ticket->player_name)->first();

            $notification['body'] = '<strong>'.htmlspecialchars(Auth::user()->player_name) . '</strong> closed your ticket <strong>' . $ticket->getType() . '</strong>.';
            $notification['url'] = route('ticket.show', $ticket->id);

            $user->notifications()->create($notification);
        }
        return redirect()->route('ticket.show', $id);
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
