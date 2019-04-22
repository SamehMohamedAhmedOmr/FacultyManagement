@extends('../layout.layout')

@section('PageContent')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ __('Heading.Dashboard') }}
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <div class="huge">{{ $memberCounts }}</div>
                            <div style="font-size:0.9em;">
                                {{ __('Heading.DashboardMembers') }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL('dashboard/members') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ __('Heading.DashboardDetails') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-calendar fa-4x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $vacationCounts }}</div>
                            <div style="font-size:0.9em;">
                                    {{ __('Heading.DashboardVacation') }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL('dashboard/vacations') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ __('Heading.DashboardDetails') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-book fa-4x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $researchCounts }}</div>
                            <div style="font-size:0.9em;">
                                {{ __('Heading.DashboardResearches') }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL('dashboard/researches') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ __('Heading.DashboardDetails') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-edit fa-4x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <div class="huge">{{ $discussionCounts }}</div>
                            <div style="font-size:0.9em;">
                                {{ __('Heading.DashboardDiscussion') }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL('dashboard/discussions') }}">
                    <div class="panel-footer">
                        <span class="pull-left">{{ __('Heading.DashboardDetails') }}</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endsection
