@extends('layouts.app')

@section('content')
    <h4>Result: {{$war->result}}</h4>
    <h4>Date: {{$war->date}}</h4>
    <h4>Score: {{$war->attacker_score}}-{{$war->defender_score}}</h4>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-fire"></i> {{$war->groupAttacker->group_Name}}'s Scoreboard</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">

                        <thead>
                            <td>Player Name</td>
                            <td>Kills</td>
                            <td>Deaths</td>
                        </thead>

                        <tbody>
                        @foreach($attackers as $attacker)
                            <tr>
                                <td class="odd gradeX"><a href="{{route('home.profile', $attacker->player_name)}}">{{$attacker->player_name}}</a></td>
                                <td class="odd gradeX">{{$attacker->kills}}</td>
                                <td class="odd gradeX">{{$attacker->deaths}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="glyphicon glyphicon-fire"></i> {{$war->groupDefender->group_Name}}'s Scoreboard</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">

                        <thead>
                        <td>Player Name</td>
                        <td>Kills</td>
                        <td>Deaths</td>
                        </thead>

                        <tbody>
                        @foreach($defenders as $defender)
                            <tr>
                                <td class="odd gradeX"><a href="{{route('home.profile', $defender->player_name)}}">{{$defender->player_name}}</a></td>
                                <td class="odd gradeX">{{$defender->kills}}</td>
                                <td class="odd gradeX">{{$defender->deaths}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection