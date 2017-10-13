@extends('layouts.app')

@section('content')
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Options</th>
            <th>Members</th>
            <th>Required Level</th>
            <th>Application Status</th>
        </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            @if($group->group_ID > 0)
            <tr>
                <td>{{$group->group_ID}}</td>
                <td>{{$group->group_Name}}</td>
                <td><a href="{{route('group.members', $group->group_ID)}}">members</a>/ <a href="{{route('group.logs', $group->group_ID)}}">logs</a>/
                    <a href="{{route('application.index', $group->group_ID)}}">applications</a>/ <a href="{{route('complaint.group',$group->group_ID)}}">complaints</a></td>
                <td>
                    {{$group->countMembers()}}/{{$group->group_Slots}}
                </td>
                <td>{{$group->group_Level}}</td>
                <td>
                    @if($group->group_Applications == 1)
                        @if(Auth::check())
                            @if(Auth::user()->player_level < $group->group_Level)
                                <button class="btn btn-danger disabled">Your level is too low to apply.</button>
                            @else
                                <a href="{{route('application.create', $group->group_ID)}}"><buttons class="btn btn-blue">Apply</buttons></a>
                            @endif

                        @endif
                    @else
                        <span style="color:red">Applications are closed.</span>
                    @endif
                </td>
            </tr>
            @endif
        @endforeach


        </tbody>
    </table>
@endsection