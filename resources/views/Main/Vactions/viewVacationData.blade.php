@extends('../layout.layout')


@section('PageContent')

<div class="Data-details py-5 my-3">
    <div class="card text-center">
        <div class="card-header row">
            <div class="col-lg-11 col-10">
                {{  __('Heading.viewVacationData') }}
            </div>
            <div class="col-lg-1 col-2">
                <a href="{{ URL('vacation') }}">
                    <i class="data-back fas fa-arrow-alt-circle-left {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></i>
                </a>
            </div>
        </div>
        <div class="card-body {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }}">
            <table class="table">

                <thead>
                    <tr>
                        <th style="width:25%">{{ __('dataTypes.member') }}</th>
                        <th style="width:75%">{{ $vacation->facultyMember->name }}</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <th>{{ __('dataTypes.description') }}</th>
                        <td>{{ $vacation->description }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.startDate') }}</th>
                        <td>{{ $vacation->startDate }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.endDate') }}</th>
                        <td>{{ $vacation->endDate }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.decisionNumber') }}</th>
                        <td>{{ $vacation->decisionNumber }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.decisionDate') }}</th>
                        <td>{{ $vacation->decisionDate }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.VacationType') }}</th>
                        <td>{{ $vacation->VacationType }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.countryName') }}</th>
                        <td>{{ $vacation->countryName }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.yearNumber') }}</th>
                        <td>{{ $vacation->yearNumber }}</td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
