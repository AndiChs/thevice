@extends('layouts.app')

@section('content')
    <div class="row" style="margin: 0 20px;">
        <h2 class="pull-left">Tickets</h2>
        <div class="pull-right">
            <a href="{{route('ticket.create')}}"><button type="button" class="btn btn-primary btn-block">Create Ticket</button></a>
        </div>
    </div>
    <hr>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Player Name</th>
                <th>Type</th>
                <td>Created At</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{$ticket->id}}</td>
                    <td><a href="{{route('home.profile', $ticket->player_name)}}">{{$ticket->player_name}}</a></td>
                    <td>{{$ticket->getType()}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{!! $ticket->status == 1 ? '<span style="color:red">Closed</span>' : '<span style="color:green">Opened</span>' !!}</td>
                    <td><a href="{{route('ticket.show', $ticket->id)}}">Read Ticket</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$tickets->render()}}
        </div>
    </div>
@endsection