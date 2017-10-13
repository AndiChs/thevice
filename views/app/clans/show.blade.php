@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-bordered datatable">

                <thead>
                    <tr>
                        <td>Rank</td>
                        <td>Name</td>
                        <td>Days in Clan</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->player_clan_rank}}</td>
                            <td>{{$user->player_clan_tag == 1 ? $clan->clan_Tag : ''}}{!! $user->linkToProfile() !!}{{$user->player_clan_tag == 2 ? $clan->clan_Tag : ''}}</td>
                            <td>{{$user->player_clan_days}} days</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-dark">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info"></i>Clan Info</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <p>Name: {{$clan->clan_Name}}</p>
                    <p>Tag: {{$clan->clan_Tag}}</p>
                    <p>Members: 2/{{$clan->clan_Slots}}</p>
                    <p>Color: <span style="color:#{{$clan->clan_Color}}">{{$clan->clan_Color}}</span></p>
                </div>

            </div>

            <div class="panel panel-dark">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-info"></i>Clan Ranks</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <p>Rank 6: {{$clan->clan_RankName6}}</p>
                    <p>Rank 5: {{$clan->clan_RankName5}}</p>
                    <p>Rank 4: {{$clan->clan_RankName4}}</p>
                    <p>Rank 3: {{$clan->clan_RankName3}}</p>
                    <p>Rank 2: {{$clan->clan_RankName2}}</p>
                    <p>Rank 1: {{$clan->clan_RankName1}}</p>

                </div>

            </div>
        </div>
    </div>
@endsection