@extends('../layout.layout')


@section('PageContent')

<div class="Data-details py-5 my-3">
    <div class="card text-center">
        <div class="card-header row">
            <div class="col-lg-11 col-10">
                {{  __('Heading.viewDiscussionData') }}
            </div>
            <div class="col-lg-1 col-2">
                <a href="{{ URL('discussion') }}">
                    <i class="data-back fas fa-arrow-alt-circle-left {{ (App::getLocale() == 'en') ? 'arrow-rotate' : ''}}"></i>
                </a>
            </div>
        </div>
        <div class="card-body {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }}">
            <table class="table">

                <thead>
                    <tr>
                        <th style="width:25%">{{ __('dataTypes.member') }}</th>
                        <th style="width:75%">{{ $discussion->facultyMember->name }}</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <th>{{ __('dataTypes.discussionName') }}</th>
                        <td>{{ $discussion->discussionName }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.discussionDate') }}</th>
                        <td>{{ $discussion->discussionDate }}</td>
                    </tr>

                    <tr>
                        <th>{{ __('dataTypes.department') }}</th>
                        <td>{{ $discussion->department }}</td>
                    </tr>

                    @foreach ($discussion->supervised as $supervisor)
                        <tr>
                            <th>{{ __('dataTypes.supervisor') }}</th>
                            <td>{{ $supervisor->name }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
