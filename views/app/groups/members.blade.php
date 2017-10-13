@extends('layouts.app')

@section('content')
    <h2>{{$group->group_Name}}'s Members</h2>
    <hr>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Rank</th>
            <th>Faction Warns</th>
            <th>Days in faction</th>

            @if($groupId == 1 || $groupId == 2)
                <th>Runners/Arrests</th>
                <th>Tickets</th>
                <th>Confiscated Licenses</th>
            @endif
            @if($groupId == 3)
                <th>Healed Patients</th>
            @endif
            @if($groupId == 4)
                <th>Orders</th>
            @endif
            @if($groupId == 5)
                <th>Announcements</th>
                <th>Lives</th>
            @endif
            @if($groupId == 6)
                <th>Contracts</th>
            @endif
            @if($groupId == 7 || $groupId == 8 || $groupId == 9 || $groupId == 10)
                <th>Drugs Deposited</th>
                <th>Materials Deposited</th>
            @endif
            <th>Last Login</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{!!$member->linkToProfile() !!}</td>
                <td>{{$member->player_team_rank }}</td>
                <td>{{$member->player_team_warns}}</td>
                <td>{{$member->player_team_days}}</td>

                @if($groupId == 1 || $groupId == 2)
                    <td>{{$member->player_team_raport_1}}/{{$member->player_team_raport_2}}</td>
                    <td>{{$member->player_team_raport_3}}</td>
                    <td>{{$member->player_team_raport_4}}</td>
                @endif
                @if($groupId == 3)
                    <td>{{$member->player_team_raport_1}}</td>
                @endif
                @if($groupId == 4)
                    <td>{{$member->player_team_raport_1}}</td>
                @endif
                @if($groupId == 5)
                    <td>{{$member->player_team_raport_1}}</td>
                    <td>{{$member->player_team_raport_2}}</td>
                @endif
                @if($groupId == 6)
                    <td>{{$member->player_team_raport_1}}</td>
                @endif
                @if($groupId == 7 || $groupId == 8 || $groupId == 9 || $groupId == 10)
                    <td>{{$member->player_team_raport_1}}</td>
                    <td>{{$member->player_team_raport_2}}</td>
                @endif
                <td>{{$member->player_last_login}}</td>
                <td><a href="{{route('complaint.create', $member->player_name)}}"><button type="button" class="btn btn-red btn-block">Report Player</button></a></td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection