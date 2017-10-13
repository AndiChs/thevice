@extends('layouts.app')

@section('content')
    <h2>{{$application->player_name}}'s application for {{$application->group->group_Name}}</h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-dark">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info"></i>Application Info</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <table class="table table-responsive">
                        <tbody>
                        <tr>
                            <td>Application Status:</td>
                            <td>{{$application->showStatus()}}</td>
                        </tr>
                        <tr>
                            <td>Created at:</td>
                            <td>{{$application->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>{!! $user->linkToProfile() !!}</td>
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
                            <td>Warns</td>
                            <td>{{$user->player_warns}}/3</td>
                        </tr>
                        <tr>
                            <td>Last Login:</td>
                            <td>{{$user->player_last_login}}</td>
                        </tr>
                        @for ($i = 0; $i < sizeof($body); $i++)
                            @if($i % 2 == 0)
                                <tr>
                            @endif

                                <td width="{{$i % 2 == 0 ? '30%' : '50%' }}">{{$body[$i]}}</td>

                            @if($i % 2 == 1)
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                </div>

            </div>
            @if(Auth::check())
                @if(Auth::user()->player_team_rank > 5)
                    @if($application->status >= 0)
                        <div class="row">
                            @if($application->status == 0)
                                <div class="col-sm-4">
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['ApplicationController@update', $application->id]]) !!}
                                        {!! Form::hidden('status', 1) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Accept Application', ['class'=>'btn btn-success']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            @endif

                            <div class="col-sm-4">
                                {!! Form::open(['method'=>'PATCH', 'action'=>['ApplicationController@update', $application->id]]) !!}
                                    {!! Form::hidden('status', -1) !!}
                                    <div class="form-group">
                                        {!! Form::submit('Reject Application', ['class'=>'btn btn-danger']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </div>
        <div class="col-sm-6">
            <div class="panel panel-dark">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-user"></i>{{$application->player_name}}'s Faction History</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    @foreach($logs as $log)
                        <p>{!! $user->showProfilePicture() !!}{{$log->player_name}} {{$log->log_info}}</p>
                        <div class="text-right"><i class="entypo-back-in-time"></i>{{$log->log_date}}</div>

                        <hr>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection