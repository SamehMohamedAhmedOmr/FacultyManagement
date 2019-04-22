@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
        <!-- /.row -->
        <div class="row forms py-5">
            @include('../Main.messages')
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.editVacationData') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <form role="form" method="POST" action="/vacation/{{ $vacation->id }}">
                                    @method('PUT')
                                    @csrf

                                    <!-- Member field -->
                                    <div class="form-group">
                                        <label>
                                            {{ __('dataTypes.selectMemeber') }}
                                        </label>
                                        <select class="form-control specialSelect" name="facultyMember" required>
                                            <option selected hidden value="">{{ __('dataTypes.selectMemeber') }}</option>

                                            @foreach ($members as $member)
                                                @if ($vacation->facultymemberId == $member->id)
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

                                    <!-- Description field -->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{  __('dataTypes.description') }}
                                        </span>
                                        <textarea class="form-control" rows="3" name="description"
                                                placeholder="{{ __('dataTypes.descriptionPlaceHolder') }}" required>{{ $vacation->description }}</textarea>
                                    </div>

                                    <!-- start & end date fields-->
                                    <div class="row input-toghter">
                                        <!-- start-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.startDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="startDate"
                                                required value="{{ $vacation->startDate }}">
                                        </div>

                                        <!-- end-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.endDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="endDate"
                                                    required value="{{ $vacation->endDate }}">
                                        </div>
                                    </div>

                                    <!-- descion number and date field-->
                                    <div class="row input-toghter">
                                        <!-- decision-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.decisionDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="decisionDate"
                                                 value="{{ $vacation->decisionDate }}">
                                        </div>

                                        <!-- decision-number field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.decisionNumber') }}
                                            </span>
                                            <input type="number" class="form-control" name="decisionNumber"
                                                 value="{{ $vacation->decisionNumber }}" min='1'>
                                        </div>
                                    </div>

                                    <!-- vacation Type and year Number field-->
                                    <div class="row input-toghter">
                                        <!-- vacation-type field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.VacationType') }}
                                            </span>
                                            <select class="form-control" id='VacationType' name="VacationType" required>
                                                <option selected hidden value="">
                                                    {{ __('dataTypes.selectVacationType') }}
                                                </option>

                                                @foreach ($vacationTypes as $vacationType)
                                                    @if ($vacation->VacationType == $vacationType)
                                                        <option value="{{ $vacationType}}" selected>
                                                            {{ $vacationType }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $vacationType}}">
                                                            {{ $vacationType }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- yearNumber field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.yearNumber') }}
                                            </span>
                                            <input type="number" class="form-control" name="yearNumber"
                                                    required value="{{ $vacation->yearNumber }}" min='1'>
                                            </div>
                                    </div>

                                    <!-- Country field -->
                                    <div class="form-group">
                                        <label>
                                            {{ __('dataTypes.selectCountryName') }}
                                        </label>
                                        <select class="form-control specialSelect" name="countryName" required>
                                            <option selected hidden value="">{{ __('dataTypes.countryName') }}</option>

                                            @foreach ($countries as $country)
                                                @if ($vacation->countryName == $country)
                                                    <option value="{{ $country}}" selected>
                                                        {{ $country }}
                                                    </option>
                                                @else
                                                    <option value="{{ $country}}">
                                                        {{ $country }}
                                                    </option>
                                                @endif
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
