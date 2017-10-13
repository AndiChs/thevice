<?php

namespace App\Http\Controllers;

use App\Clan;
use App\User;
use Illuminate\Http\Request;

class ClansController extends Controller
{
    //
    public function show($id){
        $clan = Clan::findOrFail($id);
        $users = User::where('player_clan', '=', $id)->orderBy('player_clan_rank', 'desc')->get();
        return view('app.clans.show', compact('users', 'clan'));
    }

    public function index(){
        $clans = Clan::all();
        return view('app.clans.index',compact('clans'));
    }
}
