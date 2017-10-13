@extends('layouts.app')

@section('content')
    <div class="alert alert-info text-center"><strong>Atentie!</strong>Daca doresti sa deschizi o reclamatie impotriva unui anumit jucator, cauta jucatorul respectiv folosind functia de mai jos, acceseaza-i profilul,  apasa pe 'report player' si completeaza chestionarul.</div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            {!! Form::open(['method'=>'GET', 'action'=>['HomeController@search', 'user']]) !!}

            <div class="form-group">
                {!! Form::text('name', null, ['class'=>'form-control col-xs-6', 'required'=>'true', 'placeholder'=>'Player Name', 'size'=>'4']) !!}
            </div>
            <br><br>
            <center>
                <div class="form-group">
                    {!! Form::submit('Search Player', ['class'=>'btn btn-primary']) !!}
                </div>
            </center>

            {!! Form::close() !!}
        </div>
    </div>

@endsection