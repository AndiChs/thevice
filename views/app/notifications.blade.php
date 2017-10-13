@extends('layouts.app')

@section('content')
    @foreach($notifications as $notification)
        <div class="row">
            <img src="/assets/images/bell.png" width="70">
            <span>{!!$notification->body!!}</span>
            <div class="pull-right">
                <a href="{!! $notification->url !!}"><button type="button" class="btn btn-primary btn-block">View Notification</button></a>
                <br><br><i class="entypo-back-in-time"></i>{{$notification->created_at}}
            </div>
        </div>
        <hr>
    @endforeach
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$notifications->render()}}
        </div>
    </div>
@endsection