@extends('layouts.app')

@section('content')
    <h3>{{$group->group_Name}}'s Complaints</h3>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($complaints as $complaint)
            <tr>
                <td>{{$complaint->id}}</td>
                <td><a href="{{route('complaint.show', $complaint->id)}}">{{$complaint->player_name}} - {{$complaint->getType()}}</a></td>
                <td><a href="{{route('home.profile', $complaint->complainant_name)}}">{{$complaint->complainant_name}}</a></td>
                <td>{{$complaint->created_at}}</td>
                <td>{!! $complaint->status == 1 ? '<span class="badge badge-danger badge-roundless">Closed</span>' : '<span class="badge badge-success badge-roundless">Opened</span>'!!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$complaints->render()}}
        </div>
    </div>

@endsection