@extends('layouts.app')

@section('content')
    <table class="table table-bordered datatable">

        <thead>
            <tr>
                <td>#</td>
                <td>Clan Name</td>
                <td>Tag</td>
                <td>Members</td>
            </tr>
        </thead>

        <tbody>
        @foreach($clans as $clan)
            <tr>
                <td class="odd gradeX">{{$clan->clan_ID}}</td>
                <td class="odd gradeX"><a href="{{route('clan.show', $clan->clan_ID)}}">{{$clan->clan_Name}}</a> </td>
                <td class="odd gradeX">{{$clan->clan_Tag}}</td>
                <td class="odd gradeX">{{$clan->countMembers()}} / {{$clan->clan_Slots}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection