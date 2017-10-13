@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-users"></i>Ban List</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>Player</th>
                            <th>Banned By</th>
                            <th>Reason</th>
                            <th>Ban Date</th>
                            <th width="15%">Expiration Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bans as $ban)
                            <tr>
                                <td>{{$ban->ban_id}}</td>
                                <td><a href="{{route('home.profile', $ban->player_name)}}">{{$ban->player_name}}</a></td>
                                <td><a href="{{route('home.profile', $ban->banned_by)}}">{{$ban->banned_by}}</a></td>
                                <td>{{$ban->ban_reason}}</td>
                                <td>{{$ban->ban_date}}</td>
                                <td>{{$ban->bannedUntil()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$bans->render()}}
                </div>
            </div>
        </div>
    </div>

@endsection