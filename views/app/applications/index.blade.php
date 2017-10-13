@extends('layouts.app')

@section('content')
    <h2>{{$group->group_Name}}'s Applications</h2>
    <hr>
    @if($applications->where('status', '=', 1)->count())
    <div class="panel panel-info">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><i class="entypo-info"></i>Players accepted for tests</div>
        </div>

        <!-- panel body -->

        <div class="panel-body">
            <table class="table responsive">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        @if($application->status == 1)
                            <tr>
                                <td>{{$application->id}}</td>
                                <td><a href="{{route('application.show', $application->id)}}">{{$application->player_name}}</a></td>
                                <td>{{$application->created_at}}</td>
                                <td><a href="{{route('application.show', $application->id)}}">Read Application</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @if($applications->where('status', '=', 0)->count())
        <div class="panel panel-warning">

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title"><i class="entypo-info"></i>New Applications</div>
            </div>

            <!-- panel body -->

            <div class="panel-body">
                <table class="table responsive">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        @if($application->status == 0)
                            <tr>
                                <td>{{$application->id}}</td>
                                <td><a href="{{route('application.show', $application->id)}}">{{$application->player_name}}</a></td>
                                <td>{{$application->created_at}}</td>
                                <td><a href="{{route('application.show', $application->id)}}">Read Application</a></td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <div class="panel panel-danger">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><i class="entypo-info"></i>Rejected Applications</div>
        </div>

        <!-- panel body -->

        <div class="panel-body">
            <table class="table responsive">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    @if($application->status == -1)
                        <tr>
                            <td>{{$application->id}}</td>
                            <td><a href="{{route('application.show', $application->id)}}">{{$application->player_name}}</a></td>
                            <td>{{$application->created_at}}</td>
                            <td><a href="{{route('application.show', $application->id)}}">Read Application</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-success">

        <!-- panel head -->
        <div class="panel-heading">
            <div class="panel-title"><i class="entypo-info"></i>Accepted Applications</div>
        </div>

        <!-- panel body -->

        <div class="panel-body">
            <table class="table responsive">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    @if($application->status == 2)
                        <tr>
                            <td>{{$application->id}}</td>
                            <td><a href="{{route('application.show', $application->id)}}">{{$application->player_name}}</a></td>
                            <td>{{$application->created_at}}</td>
                            <td><a href="{{route('application.show', $application->id)}}">Read Application</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection