@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="pull-right">
            <a href="{{route('unban.create')}}"><button type="button" class="btn btn-primary btn-block">Create Unban Request</button></a>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-lock"></i>Unban Requests</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Player Name</th>
                                <th>Banned By</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($unbanRequests as $unbanRequest)
                                    <tr>
                                        <td>{{$unbanRequest->id}}</td>
                                        <td>{{$unbanRequest->player_name}}</td>
                                        <td>{{$unbanRequest->banned_by}}</td>
                                        <td>{{$unbanRequest->created_at}}</td>
                                        <td>{!! $unbanRequest->status == 0 ? '<span class="badge badge-success badge-roundless">Opened</span>' : '<span class="badge badge-danger badge-roundless">Closed</span>'!!}</td>
                                        <td><a href="{{route('unban.show',$unbanRequest->id)}}">View Request</a></td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$unbanRequests->render()}}
        </div>
    </div>
@endsection