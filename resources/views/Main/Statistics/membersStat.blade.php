@extends('../layout.layout')


@section('PageContent')

<div class="Data-details py-5 my-3">
    <div class="card text-center">
        <div class="card-header row">
            <div class="col-lg-11 col-10">
                {{  __('statistics.memberStat') }}
            </div>
            <div class="col-lg-1 col-2">
                <a href="{{ URL('dashboard') }}">
                    <i class="data-back fas fa-arrow-alt-circle-left {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></i>
                </a>
            </div>
        </div>
        <div class="card-body {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }}">
            <table class="table">

                <thead>
                    <tr>
                        <th style="width:25%">{{ __('dataTypes.job') }}</th>
                        <th style="width:75%">{{ __('statistics.numbers') }}</th>
                    </tr>
                </thead>

                <tbody>


                    @foreach ($memberStatistics as $members)
                        <tr>
                            <th>{{ $members->job }}</th>
                            <td>{{ $members->counts }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
