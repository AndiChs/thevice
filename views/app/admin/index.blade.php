@extends('layouts.app')
@include('layouts.tinyeditor')
@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('includes.form_error')
            <div class="panel minimal minimal-gray">

                <div class="panel-heading">
                    <div class="panel-options">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#serverUpdates" data-toggle="tab">Server Updates</a></li>
                            <li><a href="#serverUpdates" data-toggle="tab">Second Tab</a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="serverUpdates">
                            {!! Form::open(['method'=>'POST', 'action'=>'AdminController@storeUpdate']) !!}
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            {!! Form::text('version', null, ['class'=>'form-control input-lg','required'=>'true', 'placeholder'=>'Version']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-2 post-save-changes">
                                        <div class="form-group">
                                            {!! Form::submit('Publish', ['class'=>'btn btn-primary btn-lg btn-block btn-icon']) !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                                </div>


                            {!! Form::close() !!}
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection