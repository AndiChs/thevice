@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="login-form">

                    <div class="login-content">


                        <form method="POST" role="form" action="{{ route('login') }}" id="form_login">
                            {{ csrf_field() }}

                            @if ($errors->has('player_name'))
                                <span class="form-login-error" >
                                            <strong>{{ $errors->first('player_name') }}</strong>
                                        </span>
                            @endif
                            <div class="form-group{{ $errors->has('player_name') ? ' has-error' : '' }}">


                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="entypo-user" style="color:black"></i>
                                    </div>

                                    <input type="text" class="form-control" id="username" name="player_name" placeholder="Username" autocomplete="off" value="{{ old('player_name') }}" required autofocus >
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                @if ($errors->has('password'))
                                    <span class="form-login-error">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="entypo-key" style="color:black"></i>
                                    </div>

                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>


                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-login">
                                    <i class="entypo-login"></i>
                                    Login In
                                </button>
                            </div>


                            <div class="login-bottom-links">

                                <center><a href="{{route('password.request')}}" class="link" >Forgot your password?</a></center>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
