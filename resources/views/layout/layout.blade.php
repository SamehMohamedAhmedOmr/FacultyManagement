<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sameh M.Omar">

    <title>
        @guest
            @if (\Request::is('register'))
                {{ __('Heading.register') }}
            @else
                {{ __('Heading.login') }}
            @endif
        @else
            {{ $title }}
        @endguest
    </title>

    <link rel="icon" href="{{ URL::asset('images/logo.png') }}">


    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/rtl/bootstrap.min.css') }}" rel="stylesheet">

    @if (App::getLocale() == 'ar')
        <!-- not use this in ltr -->
        <link href="{{ URL::asset('css/rtl/bootstrap.rtl.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/rtl/sb-admin-2.css') }}" rel="stylesheet">
    @else
        <link href="{{ URL::asset('css/ltr/sb-admin-2.css') }}" rel="stylesheet">
    @endif

    @if (\Request::is('dashboard'))
        <!-- Timeline CSS -->
        <link href="{{ URL::asset('css/plugins/timeline.css') }}" rel="stylesheet">
    @endif

    @if (\Request::is('buttons'))
        <!-- Social Buttons CSS -->
        <link href="{{ URL::asset('css/plugins/social-buttons.css') }}" rel="stylesheet">
    @endif

    @if (\Request::is('vacation/create') || \Request::is('vacation/*/edit')
            || \Request::is('research/create') || \Request::is('research/*/edit')
            || \Request::is('discussion/create') || \Request::is('discussion/*/edit'))
        <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/selectize.bootstrap3.css') }}">
    @endif

    <!-- font awesome v5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/customize.css') }}" rel="stylesheet">

    @if (\Request::is('facultyMember') || \Request::is('vacation')
            || \Request::is('research') || \Request::is('discussion') )
        <!-- Social Buttons CSS -->
        <link href="{{ URL::asset('css/tables.css') }}" rel="stylesheet">
    @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top"
                role="navigation" style="margin-bottom: 0; font-size: 1.2em; padding-top: 0;
                padding-bottom: 0;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('dashboard') }}">
                    {{ __('Heading.SiteName') }}
                    </a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-left">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fas fa-globe-americas fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="{{ URL('setlocale/en') }}">
                                        <img src="{{ URL::asset('images/flag/usa.png') }}" alt="" class="img-lang">
                                        <span>English</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ URL('setlocale/ar') }}">
                                        <img src="{{ URL::asset('images/flag/arab-lang.png') }}" alt="" class="img-lang">
                                        <span>العربية</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->

                    <!-- /.dropdown -->
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts dropdown-user">
                            <li>
                                <a>
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a>
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li> --}}

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                @guest
                                    @if (\Request::is('login')) <!-- if in Login Page -->
                                        <a href="{{ url('register') }}">
                                            <i class="fas fa-plus fa-fw"></i> {{ __('Heading.register') }}
                                        </a>
                                    @else <!-- if in any other Page in guest -->
                                        <a href="{{ url('/') }}">
                                            <i class="fas fa-sign-in-alt fa-fw"></i> {{ __('Heading.login') }}
                                        </a>
                                    @endif
                                @else
                                    <a onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="cursor: pointer;">
                                        <i class="fas fa-sign-out-alt fa-fw"></i> {{ __('Heading.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

            </nav>

            @guest
                @yield('content')
            @else
                <div class="MainContent">
                    <div class="row">

                        <div class="col-md-3 sidebar" role="navigation" >
                            <div class="sidebar-nav collapse navbar-collapse" id='sidebar'>
                                <ul class="nav side-menu accordion {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }} " id="side-menu">

                                    <li class="sidebar-search" style="background: #f5f6fa;">
                                        <div class="input-group custom-search-form d-flex justify-content-center"
                                            style="font-size: 5.2em; color: #353b48;">
                                            <span class="fas fa-user-graduate"></span>
                                        </div>
                                    </li>

                                    <li aria-label="Dashboard" class="dashboard">
                                        <a href="{{ url('/dashboard') }}">
                                            <i class="fa fa-signal fa-fw"></i>
                                            {{ __('Heading.Dashboard') }}
                                        </a>
                                    </li>

                                    <li aria-label="Faculty-Staff" class="list-menu">
                                        <a data-toggle="collapse" href="#facultyStaff" role="button" aria-expanded="false" aria-controls="facultyStaff">
                                            <i class="fa fa-users fa-fw"></i>
                                            {{ __('Heading.FacultyMembers') }}
                                            <span class="fa arrow {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></span>
                                        </a>

                                        <ul class="nav nav-second-level collapse" id="facultyStaff" data-parent="#side-menu">
                                            <li>
                                                <a href="{{ url('/facultyMember') }}">
                                                    {{ __('Heading.FacultyMemberslist') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/facultyMember/create') }}">
                                                    {{ __('Heading.addNewMember') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li aria-label="Vacations" class="list-menu">
                                        <a data-toggle="collapse" href="#Vacations" role="button" aria-expanded="false" aria-controls="Vacations">
                                            <i class="fa fa-calendar fa-fw"></i>
                                            {{ __('Heading.Vacations') }}
                                            <span class="fa arrow {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></span>
                                        </a>

                                        <ul class="nav nav-second-level collapse" id="Vacations" data-parent="#side-menu">
                                            <li>
                                                <a href="{{ url('/vacation') }}">
                                                    {{ __('Heading.Vacationslist') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/vacation/create') }}">
                                                    {{ __('Heading.addNewVacations') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li aria-label="ReSearch" class="list-menu">
                                        <a data-toggle="collapse" href="#ReSearch" role="button" aria-expanded="false" aria-controls="ReSearch">
                                            <i class="fa fa-book fa-fw"></i>
                                            {{ __('Heading.Research') }}
                                            <span class="fa arrow {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></span>
                                        </a>

                                        <ul class="nav nav-second-level collapse" id="ReSearch" data-parent="#side-menu">
                                            <li>
                                                <a href="{{ url('/research') }}">
                                                    {{ __('Heading.Researchlist') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/research/create') }}">
                                                    {{ __('Heading.addNewResearch') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li aria-label="Discussion" class="list-menu">
                                        <a data-toggle="collapse" href="#Discussion" role="button" aria-expanded="false" aria-controls="Discussion">
                                            <i class="fa fa-edit fa-fw"></i>
                                            {{ __('Heading.Discussions') }}
                                            <span class="fa arrow {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></span>
                                        </a>

                                        <ul class="nav nav-second-level collapse" id="Discussion" data-parent="#side-menu">
                                            <li>
                                                <a href="{{ url('/discussion') }}">
                                                    {{ __('Heading.Discussionslist') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/discussion/create') }}">
                                                {{ __('Heading.addNewDiscussions') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div id="page-wrapper" class="col-md-9 col-12 {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }} pt-3">
                            <!-- /.navbar-static-side -->
                            @yield('PageContent')
                        </div>
                    </div>
                </div>
            @endguest
    </div>

    <!-- /#wrapper -->


    <script src="{{ URL::asset('js/jquery-1.11.0.js') }}"></script>

    <script src="{{ URL::asset('bootstrap/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('js/sb-admin-2.js') }}"></script>

    @if (\Request::is('tables'))
        <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('js/jquery/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/dataTables.bootstrap.min.js') }}"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables').dataTable();
            });
        </script>
    @endif

    @if (\Request::is('facultyMember'))
        <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('js/jquery/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/dataTables.bootstrap.min.js') }}"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

        <script src="{{ URL::asset('js/deleteAjax/Member.js') }}"></script>
    @endif

    @if (\Request::is('vacation') )
    <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('js/jquery/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/dataTables.bootstrap.min.js') }}"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

        <script src="{{ URL::asset('js/deleteAjax/vacation.js') }}"></script>
    @endif

    @if (\Request::is('research') )
    <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('js/jquery/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/dataTables.bootstrap.min.js') }}"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

        <script src="{{ URL::asset('js/deleteAjax/research.js') }}"></script>
    @endif

    @if (\Request::is('discussion') )
    <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('js/jquery/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/dataTables.bootstrap.min.js') }}"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

        <script src="{{ URL::asset('js/deleteAjax/discussion.js') }}"></script>
    @endif

    @if (\Request::is('facultyMember') || \Request::is('vacation') || \Request::is('research')
            || \Request::is('discussion') )
        <script type="text/javascript">
            $(function(){
                $.fn.DataTable.ext.pager.numbers_length = 5;

                $('#dataTables').dataTable({
                    responsive: true
                });
            });
        </script>
    @endif

    @if (\Request::is('vacation/create') || \Request::is('vacation/*/edit')
            || \Request::is('research/create') || \Request::is('research/*/edit')
            || \Request::is('discussion/create') || \Request::is('discussion/*/edit'))
        <script src="{{ URL::asset('bootstrap/js/selectize.min.js') }}"></script>
        <script>
            $(function(){
                $('.specialSelect').selectize();

                $('.multiSelect').selectize({
                    maxItems: 3
                });
                $('.form-group .selectize-control').removeClass('hidden');
                $('.multiSelect').removeClass('hidden');
            });
        </script>
    @endif

</body>

</html>
