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
                                            <td>{{$ticket->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>{{$ticket->getType()}}</td>
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
                                            <td>{!!$ticket->status == 0 ? '<strong style="color:green">Opened</strong>' : '<span style="color:red">Closed</span>'!!}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Login:</td>
                                            <td>{{$user->player_last_login}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="row text-center">
                                    @if($ticket->status == 0)
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['TicketController@update', $ticket->id] ]) !!}

                                            {!! Form::hidden('status', 1) !!}
                                            <div class="form-group">
                                                {!! Form::submit('Close Ticket', ['class'=>'btn btn-danger']) !!}
                                            </div>

                                        {!! Form::close() !!}
                                    @endif

                                    @if(Auth::user()->isAdmin() && $ticket->status == 1)
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['TicketController@update', $ticket->id] ]) !!}

                                        {!! Form::hidden('status', 0) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Open Ticket', ['class'=>'btn btn-success']) !!}
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
                    <div class="panel-title"><i class="glyphicon glyphicon-comment"></i> Ticket Details</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">

                    <h4>Description:</h4>
                    <div class="panel panel-default panel-shadow" data-collapsed="0">

                        <!-- panel head -->

                        <!-- panel body -->

                        <div class="panel-body">

                            <p>{{$ticket->body}}</p>
                        </div>
                    </div>
                </div>

                <div class="panel-body">


                    <div class="panel panel-default panel-shadow" data-collapsed="0">

                        <!-- panel head -->

                        <!-- panel body -->

                        <div class="panel-body">
                            @foreach($ticket->comments()->get() as $comment)
                                <div class="row" style="margin-left: 20px">
                                    <div class="pull-left">
                                        @if($comment->player_name == $user->player_name)
                                            {!! $user->showProfilePicture() !!}
                                        @else
                                            <img src="https://panel.thevice.ro/assets/images/profile/staff.png" class="small-profile-picture">
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
                @if($ticket->status == 0)
                    <div class="text-center">
                        {!! Form::open(['method'=>'POST', 'action'=>['TicketController@storeComment', $ticket->id]]) !!}

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