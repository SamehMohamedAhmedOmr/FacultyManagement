@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
        <!-- /.row -->
        <div class="row forms">
            @include('../Main.messages')
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.editMemberData') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <form role="form" method="POST" action="/facultyMember/{{ $facultyMember->id }}">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="userName"
                                        placeholder="{{ __('dataTypes.name') }}" required value="{{ $facultyMember->name }}">
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{ __('dataTypes.job') }}
                                        </span>
                                        <select class="form-control" id='memberJob' name="job" required>
                                            <option selected hidden value="">
                                                {{ __('dataTypes.selectJob') }}
                                            </option>

                                            @foreach ($data as $job)
                                                @if ($facultyMember->job == $job)
                                                    <option value="{{ $job}}" selected>
                                                        {{ $job }}
                                                    </option>
                                                @else
                                                    <option value="{{ $job}}">
                                                        {{ $job }}
                                                    </option>
                                                @endif
                                             @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success d-block" style="width:60%">
                                                {{ __('dataTypes.edit') }}
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
