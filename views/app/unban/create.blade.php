@extends('layouts.app')

@section('content')
    @if(!count($ban))
        <div class="alert alert-danger">Your account isn't banned.</div>
    @else
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-dark panel-shadow">

                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><i class="glyphicon glyphicon-edit"></i> Create Unban Request</div>
                    </div>
                    <!-- panel body -->

                    <div class="panel-body">


                        <div class="panel panel-dark panel-shadow">

                            <!-- panel body -->

                            <div class="panel-body">
                                {!! Form::open(['method'=>'POST', 'action'=>'UnbanRequestsController@store']) !!}


                                <div class="form-group">
                                    {!! Form::label('body,', 'Description:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'required'=>'true', 'maxlength'=>'499']) !!}
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create Request', ['class'=>'btn btn-primary pull-right']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-dark panel-shadow">

                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><i class="entypo-info"></i>Unban Request Information</div>
                    </div>
                    <!-- panel body -->

                    <div class="panel-body">


                        <div class="panel panel-dark panel-shadow">

                            <!-- panel body -->

                            <div class="panel-body">
                                <strong>Your account ban details:</strong><br>
                                <br>
                                You was banned by: {{$ban->banned_by}}<br>
                                The reason of ban was: {{$ban->ban_reason}}<br>
                                You are banned on: {{$ban->ban_date}}<br>
                                Ban will expire at: {{$ban->bannedUntil()}}<br>
                                <br>
                                <strong>General unban requests details:</strong>
                                <br>
                                <br>
                                Daca stii ca ai fost sanctionat corect, nu are rost sa faci cererea de unban. Nu vei fi debanat.<br>
                                Un raspuns la o cerere de unban poate fi dat in maxim 24 de ore, insa acest termen poate fi depasit in functie de caz.<br>
                                Daca deja ti s-a raspuns la o cerere de unban, te rugam sa nu creezi alta altfel o sa primesti suspend pe panel.<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection