@extends('../layout.layout')


@section('PageContent')

<div class="Data-details py-5 my-3">
    <div class="card text-center">
        <div class="card-header row">
            <div class="col-lg-11 col-10">
                {{  __('Heading.viewResearchData') }}
            </div>
            <div class="col-lg-1 col-2">
                <a href="{{ URL('research') }}">
                    <i class="data-back fas fa-arrow-alt-circle-left {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></i>
                </a>
            </div>
        </div>
        <div class="card-body {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }}">
            <table class="table">

                <thead>
                    <tr>
                        <th style="width:25%">{{ __('dataTypes.member') }}</th>
                        <th style="width:75%">{{ $research->facultyMember->name }}</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <th>{{ __('dataTypes.researchName') }}</th>
                        <td>{{ $research->researchName }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.magazine') }}</th>
                        <td>{{ $research->magazine }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.publishDate') }}</th>
                        <td>{{ $research->publishDate }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.publishPlace') }}</th>
                        <td>{{ $research->publishPlace }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.effectCoefficient') }}</th>
                        <td>{{ $research->effectCoefficient }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.bonusValue') }}</th>
                        <td>{{ $research->bonusValue }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.participantsBonusValue') }}</th>
                        <td>{{ $research->participantsBonusValue }}</td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
