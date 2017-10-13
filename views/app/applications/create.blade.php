@extends('layouts.app')

@section('content')
    @if(count($questions))
        <div class="row">
            <div class="col-sm-6">
                @if(Session::has('error_create_application'))
                    <div class="alert alert-danger">{{session('error_create_application')}}</div>
                @endif
                {!! Form::open(['method'=>'POST', 'action'=>['ApplicationController@store', $group->group_ID]]) !!}

                {!! Form::hidden('player_name', Auth::user()->player_name) !!}

                @for($x = 0; $x < sizeof($questions); $x++)
                    <div class="form-group">
                        {!! Form::label('question_'.$x, $questions[$x]) !!}
                        {!! Form::hidden('question_'.$x, $questions[$x]) !!}
                        {!! Form::textarea('answer_'.$x, null, ['class'=>'form-control', 'size' => '30x5', 'required' => true, 'maxlength'=>'500']) !!}
                    </div>
                @endfor

                <div class="form-group">
                    {!! Form::submit('Submit Application', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-6">
                <div class="panel panel-dark">

                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><i class="entypo-user"></i>{{$user->player_name}}'s Profile</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        <div class="col-sm-6">
                            {!! $user->showSkin(120) !!}
                        </div>
                        <div class="col-sm-6">
                            <p>Level: {{$user->player_level}}</p>
                            <p>Played Hours: {{$user->player_hours}}</p>
                            <p>Faction Punish: {{$user->player_team_punish}}</p>
                            <p>Warns: {{$user->player_warns}}</p>
                            <p>Register Date: {{$user->player_register_date}}</p>
                        </div>


                        <div style="margin-top:150px">
                            <hr>
                        @foreach($logs as $log)
                            <p>{!! $user->showProfilePicture() !!} {{$log->player_name}} {{$log->log_info}}</p>
                            <div class="text-right"><i class="entypo-back-in-time"></i>{{$log->log_date}}</div>
                            <hr>
                        @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">The leader didn't set up the questions for the application. Please contact an administrator!</div>
    @endif
@endsection