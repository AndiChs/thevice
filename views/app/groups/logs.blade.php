@extends('layouts.app')

@section('content')
    <h2>{{$group->group_Name}}'s Logs</h2>
    <hr>
    <table class="table table-responsive no-padding no-borders">

        <thead>
        </thead>

        <tbody>
        @foreach($logs as $log)
            <tr>
                <td>{{$log->log_date}}</td>
                <td>{{$log->log_info}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$logs->render()}}
        </div>
    </div>
@endsection