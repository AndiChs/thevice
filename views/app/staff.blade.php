@extends('layouts.app')

@section('content')
    @if(Auth::check())
        @if(Auth::user()->player_admin > 0)
            <h5>You reports in the last 7 days: {{Auth::user()->player_admin_report}}</h5>
        @elseif(Auth::user()->player_helper > 0)
            <h5>You NRES in the last 7 days: {{Auth::user()->player_helper_report}}</h5>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-github"></i>Administrators</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Last Login</th>
                            @if (auth()->check())
                                @if(Auth::user()->player_admin > 3)
                                    <th>Reports Last 7 Days</th>
                                @endif
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr class="odd gradeX">
                                <td>{!! $admin->showStatus() !!}</td>
                                <td>{!!$admin->linkToProfile()!!}</td>
                                <td>{{$admin->player_admin}}</td>
                                <td>{{$admin->player_last_login}}</td>
                                @if (auth()->check())
                                    @if(Auth::user()->player_admin > 3)
                                        <td>{{$admin->player_admin_report}}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-user-add"></i>Helpers</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Last Login</th>
                            @if (auth()->check())
                                @if(Auth::user()->player_admin > 3)
                                    <th>Reports Last 7 Days</th>
                                @endif
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($helpers as $helper)
                            <tr class="odd gradeX">
                                <td>{!! $helper->showStatus() !!}</td>
                                <td>{!!$helper->linkToProfile()!!}</td>
                                <td>{{$helper->player_helper}}</td>
                                <td>{{$helper->player_last_login}}</td>
                                @if (auth()->check())
                                    @if(Auth::user()->player_admin > 3)
                                        <td>{{$helper->player_helper_report}}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><i class="entypo-clipboard"></i>Leaders</div>

                </div>
                <div class="panel-body with-table">
                    <table class="table table-bordered table-hover responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Faction</th>
                            <th>Last Login</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaders as $leader)
                            <tr class="odd gradeX">
                                <td>{!! $leader->showStatus() !!}</td>
                                <td>{!!$leader->linkToProfile()!!}</td>
                                <td>{{$leader->group->group_Name}}</td>
                                <td>{{$leader->player_last_login}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection