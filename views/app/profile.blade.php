@extends('layouts.app')

@section('content')

    @if(Session::has('success_change_password'))
        <div class="alert alert-success">{{session('success_change_password')}}</div>
    @endif
    @if(Session::has('error_change_password'))
        <div class="alert alert-danger">{{session('error_change_password')}}</div>
    @endif
    <div class="row">
        @if(count($ban))
            <div class="alert alert-danger">
                <strong>{{$user->player_name}}</strong> has been banned by <strong>{{$ban->banned_by}}</strong>, reason: <strong>{{$ban->ban_reason}}</strong>.<br>
                @if($date = $ban->bannedUntil() != 'Never')
                    The ban will expire on <strong>{{$ban->bannedUntil()}}</strong>.
                @else
                    This ban is <strong>permanent</strong>.
                @endif
            </div>
        @endif
        <div class="col-md-3">

            <div class="panel panel-default panel-shadow" data-collapsed="0">

                <!-- panel head -->

                <!-- panel body -->

                <div class="panel-body">
                        <center>

                        {!! $user->showSkin() !!}

                            <h3>
                                @if($user->player_in_game_id != -1)
                                    <i class="entypo-user text-success"></i>
                                @else
                                    <i class="entypo-user text-danger"></i>
                                @endif
                            {{$user->player_name}}</h3>
                            <br>

                            @if($user->isAdmin())
                                <span class="badge badge-primary badge-roundless">Admin</span><br>
                            @endif
                            @if($user->player_helper > 0)
                                <span class="badge badge-primary badge-roundless" style="margin-top: 3px">Helper</span><br>
                            @endif
                            @if($user->player_team_rank == 7)
                                <span class="badge badge-warning badge-roundless" style="margin-top: 3px">Faction Leader</span><br><br>
                            @endif
                            @if($user->player_clan_rank == 6)
                                <span class="badge badge-success badge-roundless" style="margin-top: 3px">Clan Owner</span><br><br>
                            @endif

                        </center>
                    <hr>
                    @if(Auth::check())
                        @if(Auth::user()->player_name != $user->player_name)
                            <a href="{{route('complaint.create', $user->player_name)}}"><button type="button" class="btn btn-red btn-block">Report Player</button></a>
                        @endif
                    @endif
                </div>

            </div>

        </div>

        <div class="col-md-8">

            <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
                <li class="active">
                    <a href="#home" data-toggle="tab">
                        <i class="entypo-home"></i>
                        <span class="hidden-xs">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#factionhistory" data-toggle="tab">
                        <i class="entypo-user"></i>
                        <span class="hidden-xs">Faction History</span>
                    </a>
                </li>
                <li>
                    <a href="#vehicles" data-toggle="tab">
                        <i class="entypo-flight"></i>
                        <span class="hidden-xs">Vehicles</span>
                    </a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->player_name === $user->player_name)
                        <li>
                            <a href="#settings" data-toggle="tab">
                                <i class="entypo-cog"></i>
                                <span class="hidden-xs">Settings</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <table class="table table-responsive no-padding no-borders">
                        <tbody>
                        <tr>
                            <td>Faction</td>
                            <td>{{$user->group->group_Name}} {{ $user->group->group_ID > 0 ? ', rank '.$user->player_team_rank : ''}}</td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>{{$user->player_level}}</td>
                        </tr>
                        <tr>
                            <td>Played Hours</td>
                            <td>{{$user->player_hours}}</td>
                        </tr>
                        @if($user->player_clan > 0)
                            <tr>
                                <td>Clan</td>
                                <td>{{$user->clan->clan_Name}}, rank {{$user->player_clan_rank}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Phone Number</td>
                            <td>{{$user->player_phone}}</td>
                        </tr>
                        <tr>
                            <td>Register Date</td>
                            <td>{{$user->player_register_date}}</td>
                        </tr>
                        <tr>
                            <td>Last Login</td>
                            <td>{{$user->player_last_login}}</td>
                        </tr>
                        @if(Auth::check())
                            @if(Auth::user()->player_id == $user->player_id || Auth::user()->isAdmin())
                                <tr>
                                    <td>Email address</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Money</td>
                                    <td>{{'$'.number_format($user->player_cash)}}</td>
                                </tr>
                                <tr>
                                    <td>Bank Balance</td>
                                    <td>{{'$'.number_format($user->player_bank)}}</td>
                                </tr>
                                <tr>
                                    <td>Premium Account</td>
                                    <td>{{$user->player_premium ? 'Yes' : 'No'}}</td>
                                </tr>
                                <tr>
                                    <td>Premium Points</td>
                                    <td>{{$user->player_premium_points}}</td>
                                </tr>
                            @endif
                        @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="tile-stats tile-gray col-sm-6 col-xs-6">
                            <div class="icon">
                                <i class="entypo-home"></i>
                            </div>
                            <div class="num">
                                House
                            </div>
                            <h3>{{$user->player_house == - 1 ? 'This player doesn\'t own a house.' : 'This player owns the house #'.$user->player_house.'.'}}</h3>
                        </div>
                        <div class="tile-stats tile-gray col-sm-6 col-xs-6">
                            <div class="icon">
                                <i class="entypo-suitcase"></i>
                            </div>
                            <div class="num">
                                Business
                            </div>
                            <h3>{{$user->player_business == 0 ? 'This player doesn\'t own a business.' : 'This player owns the business #'.$user->player_business.'.'}}</h3>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="factionhistory">

                        <table class="table table-responsive no-padding no-borders">

                            <thead>
                            <tr>
                                <th></th>
                                <th><i class="entypo-back-in-time"></i>Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$user->player_name}} {{$log->log_info}}</td>
                                    <td>{{$log->log_date}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                </div>
                <div class="tab-pane" id="vehicles">

                    <table class="table responsive no-padding no-borders">

                        <thead>
                        <tr>
                            <th><i class="entypo-flight"></i>Model</th>
                            <th><i class="entypo-book-open"></i>Vehicle Name</th>
                            <th><i class="entypo-gauge"></i>Odometer</th>
                            <th><i class="entypo-back-in-time"></i>Age</th>
                            <th><i class="entypo-brush"></i>Colours</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{!! $car->photo() !!}</td>
                                <td>{{$car->getVehicleName()}} [ID:{{$car->car_id}}]</td>
                                <td>{{number_format($car->KM)}} kilometers</td>
                                <td>{{$car->Days}} days</td>
                                <td>{!! $car->getVehicleColor($car->ColorOne) !!} {!! $car->getVehicleColor($car->ColorTwo) !!} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                @if(Auth::check())
                    @if(Auth::user()->player_name === $user->player_name)
                        <div class="tab-pane text-center" id="settings">
                            {!! Form::open(['method'=>'POST', 'action'=>'UserController@changeUserPassword']) !!}

                            <div class="form-group">
                                {!! Form::password('currentPassword', ['class'=>'form-control', 'placeholder'=>'Current Password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::password('newPassword', ['class'=>'form-control', 'placeholder'=>'New Password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::password('newPassword2', ['class'=>'form-control', 'placeholder'=>'New Password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Change Password', ['class'=>'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection