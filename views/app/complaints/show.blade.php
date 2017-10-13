@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-5">
            <div class="panel panel-default panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-user"></i>Complaint Against {{$user->player_name}}</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">



                    <div class="panel panel-default panel-shadow" data-collapsed="0">

                        <!-- panel head -->

                        <!-- panel body -->

                        <div class="panel-body">
                            <div class="pull-left">

                                {!! $user->showSkin(300) !!}

                            </div>
                            <div class="pull-right">
                                <table class="table responsive table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>
                                            @if($user->player_in_game_id != -1)
                                                <i class="entypo-user text-success"></i>
                                            @else
                                                <i class="entypo-user text-danger"></i>
                                            @endif
                                            <a href="{{route('home.profile', $user->player_name)}}">{{$user->player_name}}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Level:</td>
                                        <td>{{$user->player_level}}</td>
                                    </tr>

                                    <tr>
                                        <td>Played Hours:</td>
                                        <td>{{$user->player_hours}}</td>
                                    </tr>

                                    <tr>
                                        <td>Warns:</td>
                                        <td>{{$user->player_warns}}/3</td>
                                    </tr>

                                    <tr>
                                        <td>Faction:</td>
                                        <td>{{$user->group->group_Name}}, rank {{$user->player_team_rank}}</td>
                                    </tr>

                                    <tr>
                                        <td>Faction Info:</td>
                                        <td>{{$user->player_team_punish}} Faction Punish, {{$user->player_team_warns}}/3 Faction Warns</td>
                                    </tr>

                                    <tr>
                                        <td>Last Login:</td>
                                        <td>{{$user->player_last_login}}</td>
                                    </tr>

                                    <tr>
                                        <td>Register Date:</td>
                                        <td>{{$user->player_register_date}}</td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            @if(Auth::check())
                @if(Auth::user()->isAdmin() || Auth::user()->player_team_rank > 5 && $complaint->type == 4 && Auth::user()->player_team == $complaint->faction_id || $complaint->complainant_name == Auth::user()->player_name && $complaint->status == 0)
                    <div class="panel panel-dark panel-shadow">

                        <!-- panel head -->
                        <div class="panel-heading">
                            <div class="panel-title"><i class="entypo-cog"></i>Complaint Tools</div>
                        </div>
                        <div class="panel-body">
                            <div class="row text-center">
                                @if($complaint->status == 0)
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                    {!! Form::hidden('status', 1) !!}
                                    <div class="form-group">
                                        {!! Form::submit('Close Complaint', ['class'=>'btn btn-danger']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                    {!! Form::hidden('status', 0) !!}
                                    <div class="form-group">
                                        {!! Form::submit('Open Complaint', ['class'=>'btn btn-success']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                @endif
                                <hr>
                            </div>
                            @if(Auth::user()->player_team_rank > 5 && $complaint->type == 4 && Auth::user()->player_team == $complaint->faction_id && $complaint->faction_id > 0)
                                @if($complaint->status == 0)
                                    <div class="row text-center">
                                        <h4>Faction Warn and close</h4>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                        <div class="form-group">
                                            {!! Form::text('reason', null, ['class'=>'form-control','placeholder'=>'Insert here the reason', 'required'=>'true']) !!}
                                        </div>

                                        {!! Form::hidden('status', 1) !!}

                                        {!! Form::hidden('actionType', 5) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Faction Warn and Close', ['class'=>'btn btn-danger']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            @endif
                            @if(Auth::user()->isAdmin() && $complaint->type != 4)
                                @if($complaint->status == 0)
                                    <div class="row text-center">
                                        <h4>Warn and close</h4>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                        <div class="form-group">
                                            {!! Form::text('reason', null, ['class'=>'form-control','placeholder'=>'Insert here the reason', 'required'=>'true']) !!}
                                        </div>

                                        {!! Form::hidden('status', 1) !!}

                                        {!! Form::hidden('actionType', 1) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Warn and Close', ['class'=>'btn btn-danger']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                    <div class="row text-center">
                                        <h4>Jail and close</h4>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                        <div class="form-group">
                                            {!! Form::text('amount', null, ['class'=>'form-control','placeholder'=>'Insert here the jail time!', 'required'=>'true']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::text('reason', null, ['class'=>'form-control','placeholder'=>'Insert here the reason!', 'required'=>'true']) !!}
                                        </div>

                                        {!! Form::hidden('status', 1) !!}

                                        {!! Form::hidden('actionType', 4) !!}

                                        <div class="form-group">
                                            {!! Form::submit('Jail and Close', ['class'=>'btn btn-danger']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                    <div class="row text-center">
                                        <h4>Mute and close</h4>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                        <div class="form-group">
                                            {!! Form::text('amount', null, ['class'=>'form-control','placeholder'=>'Insert here the mute time!', 'required'=>'true']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::text('reason', null, ['class'=>'form-control','placeholder'=>'Insert here the reason', 'required'=>'true']) !!}
                                        </div>

                                        {!! Form::hidden('status', 1) !!}

                                        {!! Form::hidden('actionType', 3) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Mute and Close', ['class'=>'btn btn-danger']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                    <div class="row text-center">
                                        <h4>Ban and close</h4>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['ComplaintsController@update', $complaint->id] ]) !!}

                                        <div class="form-group">
                                            {!! Form::text('amount', null, ['class'=>'form-control','placeholder'=>'Insert here the ban time!', 'required'=>'true']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::text('reason', null, ['class'=>'form-control','placeholder'=>'Insert here the reason', 'required'=>'true']) !!}
                                        </div>

                                        {!! Form::hidden('status', 1) !!}

                                        {!! Form::hidden('actionType', 2) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Ban and Close', ['class'=>'btn btn-danger']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info-circled"></i> Complaint Details</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">

                    <table class="table responsive table-bordered">
                        <tbody>
                            <tr>
                                <td>Complainant Name:</td>
                                <td><a href="{{route('home.profile', $complaint->complainant_name)}}">{{$complaint->complainant_name}}</a></td>
                            </tr>
                            <tr>
                                <td>Complainant Level:</td>
                                <td>{{$complainant->player_level}}</td>
                            </tr>
                            <tr>
                                <td>Created At:</td>
                                <td>{{$complaint->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Reason:</td>
                                <td>{{$complaint->getType()}}</td>
                            </tr>

                            <tr>
                                <td>Details:</td>
                                <td>{{$complaint->body}}</td>
                            </tr>

                            <tr>
                                <td>Proofs:</td>
                                <td>{{$complaint->proofs}}</td>
                            </tr>

                            <tr>
                                <td>Status:</td>
                                <td>{!!$complaint->status == 0 ? '<strong style="color:green">Opened</strong>' : '<span style="color:red">Closed</span>'!!}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="panel-body">



                </div>
            </div>
            <div class="panel panel-default panel-shadow" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-comment"></i> Comments</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">
                    @foreach($complaint->comments()->get() as $comment)
                        <div class="row" style="margin-left: 20px">
                            <div class="pull-left">
                                @if($comment->player_name==$user->player_name)
                                    {!! $user->showProfilePicture() !!}

                                @elseif($comment->complainant_name==$complainant->player_name)
                                    {!! $complainant->showProfilePicture() !!}

                                @else
                                    <img src="http://panel.thevice.ro/assets/images/profile/staff.png" class="small-profile-picture">
                                @endif
                                <a href="{{route('home.profile', $comment->player_name)}}" style="color:#003da0;"><strong>{{$comment->player_name}}: </strong></a>
                                {!! $comment->body !!}
                            </div>
                            <div class="pull-right" style="margin-right: 20px;"><i class="entypo-back-in-time"></i>{{$comment->created_at->diffForHumans()}}</div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
            @if($complaint->status == 0)
                @if(Auth::user()->isAdmin() == 1 || $complaint->type == 4 && Auth::user()->player_team_rank > 5 && Auth::user()->player_team == $complaint->faction_id || Auth::user()->player_name == $complaint->player_name || Auth::user()->player_name == $complaint->complainant_name)
                    <div class="text-center">
                        {!! Form::open(['method'=>'POST', 'action'=>['ComplaintsController@storeComment', $complaint->id]]) !!}

                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'maxlength'=>'500', 'rows'=>'4', 'cols'=>'50']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection