@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-users"></i>Top Players</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Faction</th>
                            <th>Hours Played</th>
                            <th>Respect Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $x=1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$x++}}</td>
                                <td>{!!$user->linkToProfile()!!}</td>
                                <td>{{$user->player_level}}</td>
                                <td>{{$user->group->group_Name}}</td>
                                <td>{{$user->player_hours}}</td>
                                <td>{{$user->player_experience}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop