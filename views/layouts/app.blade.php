<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="assets/images/favicon.ico">

    <link rel="stylesheet" href="{{asset('assets/css/libs.css')}}">




    <title>The Vice | Panel</title>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="{{route('home.index')}}">
                        <img src="https://panel.thevice.ro/assets/images/logo@2x.png" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li>
                    <a href="{{route('home.index')}}">
                        <i class="entypo-gauge"></i>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('home.online')}}">
                        <i class="entypo-user"></i>
                        <span class="title">Online Players</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('home.staff')}}">
                        <i class="entypo-suitcase"></i>
                        <span class="title">Staff</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('home.searchPlayer')}}">
                        <i class="entypo-search"></i>
                        <span class="title">Search Player</span>
                    </a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->player_admin > 0)
                        <li>
                            <a href="{{route('admin.index')}}">
                                <i class="entypo-lamp"></i>
                                <span class="title">Admin Panel</span>
                            </a>
                        </li>
                    @endif
                @endif
                <li>
                    <a href="{{route('complaint.index')}}">
                        <i class="entypo-chat"></i>
                        <span class="title">Complaints</span>
                    </a>
                </li>
                @if(Auth::check())
                    <li>
                        <a href="{{route('ticket.index')}}">
                            <i class="entypo-users"></i>
                            <span class="title">Tickets</span>
                        </a>
                    </li>
                @endif
                @if(Auth::check())
                    @if(Auth::user()->isTeamLeader())
                        <li>
                            <a href="{{route('group.panel')}}">
                                <i class="entypo-flow-tree"></i>
                                <span class="title">Leader Panel</span>
                            </a>
                        </li>
                    @endif
                @endif
                <li>
                    <a href="{{route('group.index')}}">
                        <i class="entypo-users"></i>
                        <span class="title">Factions</span>
                    </a>
                </li>

                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-chart-bar"></i>
                        <span class="title">Statistics</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('home.businesses')}}">
                                <i class="glyphicon glyphicon-briefcase"></i>
                                <span class="title">Businesses</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('home.houses')}}">
                                <i class="glyphicon glyphicon-home"></i>
                                <span class="title">Houses</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('home.wars')}}">
                                <i class="glyphicon glyphicon-fire"></i>
                                <span class="title">Gang Wars</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('home.top50users')}}">
                                <i class="glyphicon glyphicon-sort-by-order"></i>
                                <span class="title">Top Players</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('home.dealership')}}">
                                <i class="glyphicon glyphicon-road"></i>
                                <span class="title">Dealership</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('home.updates')}}">
                        <i class="entypo-info"></i>
                        <span class="title">Server Updates</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clan.index')}}">
                        <i class="entypo-flow-tree"></i>
                        <span class="title">Clans</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('unban.index')}}">
                        <i class="entypo-github"></i>
                        <span class="title">Unban Requests</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('home.bans')}}">
                        <i class="entypo-cc-remix"></i>
                        <span class="title">Ban List</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->

            <div class="col-md-6 col-sm-8 clearfix">

            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">

                    @if(Auth::check())
                        <ul class="user-info pull-left pull-right-xs pull-none-xsm">

                            <!-- Message Notifications -->
                            <li class="notifications pull-right dropdown">
                                <?php
                                    $numberOfNotifications = Auth::user()->notifications->where('seen', '=', 0)->count();
                                ?>

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="entypo-bell"></i>
                                    @if($numberOfNotifications > 0)
                                        <span class="badge badge-secondary">{{$numberOfNotifications}}</span>
                                    @endif
                                </a>


                                <ul class="dropdown-menu">
                                    <li>

                                        <ul class="dropdown-menu-list scroller">
                                        @foreach(Auth::user()->notifications->reverse()->take(5) as $notification)
                                            <li class="active">
                                                    <a href="{{$notification->url}}">
                                                <span class="image pull-right">
                                                    {!! Auth::user()->showProfilePicture() !!}
                                                </span>



                                                            <span class="line desc small">
                                                    {!! $notification->body !!}
                                                </span>
                                                        <span class="line">
                                                    <i class="entypo-back-in-time"></i>
                                                            {{$notification->created_at->diffForHumans()}}
                                                </span>
                                                </a>
                                            </li>


                                        @endforeach


                                        </ul>
                                    </li>

                                    <li class="external">
                                        <a href="{{route('user.notifications')}}">View All Notifications</a>
                                    </li>
                                </ul>

                            </li>



                        </ul>

                        <ul class="user-info pull-left pull-none-xsm">

                            <!-- Profile Info -->

                            <li class="profile-info pull-right dropdown"><!-- add class "pull-right" if you want to place this from right -->

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {!! Auth::user()->showProfilePicture() !!}
                                    {{Auth::user()->player_name}}
                                </a>

                                <ul class="dropdown-menu">

                                    <!-- Reverse Caret -->
                                    <li class="caret"></li>

                                    <!-- Profile sub-links -->
                                    <li>
                                        <a href="{{route('home.profile', Auth::user()->player_name)}}">
                                            <i class="entypo-user"></i>
                                            Profile
                                        </a>
                                    </li>


                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="entypo-logout right"></i>Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        </ul>


                    @endif




                    @if(Auth::guest())
                        <li>
                            <a href="{{route('login')}}">
                                Log In <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    @endif

                </ul>

            </div>

        </div>

       @yield('content')

        <!-- Footer -->
        <footer class="main text-center">


            <a href="{{route('home.terms')}}">Terms And Conditions</a> |
            <a href="{{route('home.privacy')}}">Privacy Policy</a><br>
            Copyright &copy; 2017 <strong>TheVice</strong>
        </footer>
    </div>


</div>

<script src="{{asset('assets/js/libs.js')}}"></script>


</body>
</html>