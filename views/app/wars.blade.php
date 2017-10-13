@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-fire"></i> Gang Wars</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">

                        <thead>
                            <td><strong>Date</strong></td>
                            <td><strong>Attacker</strong></td>
                            <td><strong>Defender</strong></td>
                            <td><strong>Score</strong></td>
                            <td><strong>Result</strong></td>
                            <td><strong>Logs</strong></td>
                        </thead>

                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{$log->date}}</td>
                                <td>{{$log->groupAttacker->group_Name}}</td>
                                <td>{{$log->groupDefender->group_Name}}</td>
                                <td>{{$log->attacker_score}}-{{$log->defender_score}}</td>
                                <td>{{$log->result}}</td>
                                <td><a href="{{route('home.war', $log->id)}}">View Logs</a></td>
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
            {{$logs->render()}}
        </div>
    </div>
@endsection