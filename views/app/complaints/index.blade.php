@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="row" style="margin: 0 20px;">
            <h2 class="pull-left">Complaints</h2>
            <div class="pull-right">
                <a href="{{route('home.searchPlayer')}}"><button type="button" class="btn btn-primary btn-block">Create Complaint</button></a>
            </div>
        </div>
    @endif
    <hr>
    @if(isset($personalComplaints))
        @if(count($personalComplaints))
            <div class="panel panel-gray" data-collapsed="1">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Complaints where you are implicated:</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <table class="table table-responsive">
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
                        @foreach($personalComplaints as $complaint)
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
                </div>
            </div>
            <hr>
        @endif
    @endif
    <table class="table table-responsive">
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
    @if(Auth::check())
        @if(Auth::user()->player_admin > 0)
            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$complaints->render()}}
                </div>
            </div>
        @endif
    @endif

@endsection