@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-5">
            <div class="panel panel-default panel-shadow">

                <!-- panel head -->

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
                                        <td>Created At:</td>
                                        <td>{{$unbanRequest->created_at}}</td>
                                    </tr>
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
                                    <td>Level:</td>
                                    <td>{{$user->player_level}}</td>
                                    <tr>
                                        <td>Status:</td>
                                        <td>{!!$unbanRequest->status == 0 ? '<strong style="color:green">Opened</strong>' : '<span style="color:red">Closed</span>'!!}</td>
                                    </tr>
                                    @if(count($ban))
                                        <tr>
                                            <td>Banned By:</td>
                                            <td>{{$ban->banned_by}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ban Reason:</td>
                                            <td>{{$ban->ban_reason}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ban Date:</td>
                                            <td>{{$ban->ban_date}}</td>
                                        </tr>
                                        <tr>
                                            <td>Ban expires at:</td>
                                            <td>{{$ban->bannedUntil()}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                                <div class="row text-center">
                                    @if(Auth::user()->player_admin > 0 && $unbanRequest->status == 0)
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['UnbanRequestsController@update', $unbanRequest->id] ]) !!}

                                        {!! Form::hidden('status', 1) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Close Request', ['class'=>'btn btn-danger col-sm-6']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                        {!! Form::open(['method'=>'PATCH', 'action'=>['UnbanRequestsController@update', $unbanRequest->id] ]) !!}

                                        {!! Form::hidden('status', 1) !!}
                                        {!! Form::hidden('unban', 1) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Close And Unban', ['class'=>'btn btn-success col-sm-6']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-comment"></i> Unban Request Details</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">

                    <h4>Description:</h4>
                    <div class="panel panel-default panel-shadow" data-collapsed="0">

                        <!-- panel head -->

                        <!-- panel body -->

                        <div class="panel-body">

                            <p>{{$unbanRequest->body}}</p>
                        </div>
                    </div>
                </div>

                <div class="panel-body">


                    <div class="panel panel-default panel-shadow" data-collapsed="0">

                        <!-- panel head -->

                        <!-- panel body -->

                        <div class="panel-body">
                            @foreach($unbanRequest->comments()->get() as $comment)
                                <div class="row" style="margin-left: 20px">
                                    <div class="pull-left">
                                        @if($comment->player_name == $user->player_name)
                                            {!! $user->showProfilePicture() !!}
                                        @else
                                            <img src="http://thevice.dev/assets/images/profile/staff.png" class="small-profile-picture">
                                        @endif
                                        <a href="{{route('home.profile', $comment->player_name)}}" style="color:#003da0;"><strong>{{$comment->player_name}}: </strong></a>
                                        {{$comment->body}}
                                    </div>
                                    <div class="pull-right" style="margin-right: 20px;"><i class="entypo-back-in-time"></i>{{$comment->created_at->diffForHumans()}}</div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($unbanRequest->status == 0)
                    <div class="text-center">
                        {!! Form::open(['method'=>'POST', 'action'=>['UnbanRequestsController@storeComment', $unbanRequest->id]]) !!}

                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'maxlength'=>'500']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection