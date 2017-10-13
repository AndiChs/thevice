@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-dark panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-edit"></i> Create complaint against {{$user->player_name}}</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">
                    <div class="row">
                        <div class="text-center">
                            {!! $user->showSkin(200) !!}


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
                                    <td>Faction:</td>
                                    <td>{{$user->group->group_Name}}</td>
                                </tr>
                                <tr>
                                    <td>Last Login:</td>
                                    <td>{{$user->player_last_login}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-dark panel-shadow">

                        <!-- panel body -->
                        <div class="panel-heading">
                            <div class="panel-title"><i class="glyphicon glyphicon-edit"></i> Complaint</div>
                        </div>

                        <div class="panel-body">
                            {!! Form::open(['method'=>'POST', 'action'=>['ComplaintsController@store', $user->player_name]]) !!}

                            <div class="form-group">
                                {!! Form::select('type', $complaintTypes, null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('body,', 'Details:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'required'=>'true', 'maxlength'=>'499','rows'=>'4', 'cols'=>'50']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('proofs,', 'Proofs:') !!}
                                {!! Form::textarea('proofs', null, ['class'=>'form-control', 'required'=>'true', 'maxlength'=>'499', 'rows'=>'4', 'cols'=>'50']) !!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Complaint', ['class'=>'btn btn-primary pull-right']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-dark panel-shadow">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info"></i>Complaint Information</div>
                </div>
                <!-- panel body -->

                <div class="panel-body">


                    <div class="panel panel-dark panel-shadow">

                        <!-- panel body -->

                        <div class="panel-body">
                            <strong>Informatii legate de crearea unei reclamatii</strong><br>
                            <br>
                            Inainte de a deschide o reclamatia asigurati-va ca ati luat la cunostinta tot <a href="https://forum.thevice.ro/index.php?/topic/29-regulamentul-general-al-serverului/">regulamentul general al serverului</a>.<br>
                            Timpul de inchidere al unei reclamatii poate fi de pana la 48 de ore, insa acest termen poate varia in functie de complexitatea fiecarui caz.<br>
                            Sunteti rugati sa nu creati reclamatii in batjocora, acest lucru poate duce la suspendarea contului pe panel.<br>
                            Reclamatiile ce nu contin dovezi sau contin dovezi editate nu sunt luate in considerare si poate duce la suspendarea contului pe panel.<br>
                            Puteti uploada toate imaginile pentru dovezi pe site-ul imgur.com iar toate videoclipurile pe site-ul youtube.com.<br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection