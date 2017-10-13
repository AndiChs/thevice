@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num" data-start="0" data-end="{{$users}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Accounts</h3>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-home"></i></div>
                <div class="num" data-start="0" data-end="{{$houses}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>Houses</h3>
            </div>

        </div>

        <div class="clear visible-xs"></div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-aqua">
                <div class="icon"><i class="entypo-suitcase"></i></div>
                <div class="num" data-start="0" data-end="{{$businesses}}" data-postfix="" data-duration="1500" data-delay="1200">0</div>

                <h3>Businesses</h3>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-flight"></i></div>
                <div class="num" data-start="0" data-end="{{$cars}}" data-postfix="" data-duration="1500" data-delay="1800">0</div>

                <h3>Vehicles</h3>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">

            <div class="panel panel-dark" id="charts_env">

                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo entypo-users"></i>Recent Activity</div>
                </div>

                <div class="panel-body">

                    <div class="tab-content">

                        <ul class="cbp_tmtimeline">
                            @foreach($logs as $log)
                                <li>
                                    <time class="cbp_tmtime" datetime="{{$log->log_date}}">
                                        <span><i class="entypo-back-in-time"></i>{{ Carbon\Carbon::parse($log->log_date)->diffForHumans() }}</span> <span class="large"></span></time>

                                    <div class="cbp_tmicon
                                                {{ strpos($log->log_info, 'leader') == false ? '' : 'bg-success'}}
                                                {{ strpos($log->log_info, 'joined') == false ? '' : 'bg-success'}}
                                                {{ strpos($log->log_info, 'left') == false ? '' : 'bg-danger'}}
                                            ">
                                        <i class="entypo-user"></i>
                                    </div>

                                    <div class="cbp_tmlabel">
                                        <strong><a href="{{route('home.profile', $log->player_name)}}">{{$log->player_name}}</strong></a>
                                        <span>{{$log->log_info}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>




                    </div>

                </div>



            </div>

        </div>

        <div class="col-sm-4">

            <div class="panel panel-dark">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo entypo-info"></i>Server Updates</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    @if(count($update))
                        <h3 class="text-center">Version:{{ $update->version }}</h3>
                        <h4 class="text-center">{!! $update->body !!}</h4>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
