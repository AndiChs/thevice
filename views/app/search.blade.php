@extends('layouts.app')

@section('content')
    @if(count($users) == 0)
        <div class="alert alert-danger">We didn't find a match in our database.</div>
    @else
        <table class="table responsive">
            <thead>
            <tr>
                <th>Name</th>
                <th>Level</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{!! $user->linkToProfile() !!}</td>
                    <td>{{$user->player_level}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$users->render()}}
            </div>
        </div>
    @endif

@endsection