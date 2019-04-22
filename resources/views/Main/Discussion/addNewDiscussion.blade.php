@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
        <!-- /.row -->
        <div class="row forms py-5">
            @include('../Main.messages')
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.addNewDiscussions') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <form role="form" method="POST" action="/discussion">
                                    @csrf

                                    <!-- Member field -->
                                    <div class="form-group">
                                        <select class="form-control specialSelect" name="facultyMember" required>
                                            <option selected hidden value="">{{ __('dataTypes.selectMemeber') }}</option>

                                            @foreach ($members as $member)
                                                @if (\Request::old('facultyMember') == $member->id)
                                                    <option value="{{ $member->id}}" selected>
                                                        {{ $member->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $member->id}}">
                                                        {{ $member->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- discussionName field -->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{ __('dataTypes.discussionName') }}
                                        </span>
                                        <input type="text" class="form-control" name="discussionName"
                                            required value="{{ old('discussionName') }}">
                                    </div>

                                    <!-- department field -->
                                    <div class="form-group">
                                        <select class="form-control specialSelect" name="department" required>
                                            <option selected hidden value="">{{ __('dataTypes.department') }}</option>

                                            @foreach ($Departments as $department)
                                                @if (\Request::old('department') == $department)
                                                    <option value="{{ $department}}" selected>
                                                        {{ $department }}
                                                    </option>
                                                @else
                                                    <option value="{{ $department}}">
                                                        {{ $department }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- discussionDate field -->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{ __('dataTypes.discussionDate') }}
                                        </span>
                                        <input type="date" class="form-control" name="discussionDate"
                                            required value="{{ old('discussionDate') }}">
                                    </div>

                                    <!-- Member field -->
                                    <div class="form-group">
                                        <label>{{ __('dataTypes.SelectSupervisor') }}</label>
                                        <select class="form-control multiSelect" name="supervisors[]" required>
                                            <option selected hidden value="">{{ __('dataTypes.selectMemeber') }}</option>

                                            @foreach ($members as $member)
                                                <option value="{{ $member->id}}">
                                                    {{ $member->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary d-block" style="width:60%">
                                            {{ __('dataTypes.save') }}
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

@endsection
