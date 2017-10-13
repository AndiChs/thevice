@extends('layouts.app')

@section('content')
    @foreach($updates as $update)
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-dark" data-collapsed="0">
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title"><i class="entypo-vimeo"></i>{{ $update->version }}</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div>
                    </div> <!-- panel body -->
                    <div class="panel-body" style="display: block;">
                        <p>{!! $update->body !!}</p>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection