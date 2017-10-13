<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestServerUpdate;
use App\Update;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('app.admin.index');
    }

    public function storeUpdate(RequestServerUpdate $request){

        Update::create($request->all());
        return redirect()->back();
    }
}
