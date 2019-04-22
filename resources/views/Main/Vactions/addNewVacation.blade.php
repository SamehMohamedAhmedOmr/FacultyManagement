@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
        <!-- /.row -->
        <div class="row forms py-5">
            @include('../Main.messages')
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.addNewVacations') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <form role="form" method="POST" action="/vacation">
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

                                    <!-- Description field -->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{  __('dataTypes.description') }}
                                        </span>
                                        <textarea class="form-control" rows="3" name="description"
                                                placeholder="{{ __('dataTypes.descriptionPlaceHolder') }}" required>{{ old('description') }}</textarea>
                                    </div>

                                    <!-- start & end date fields-->
                                    <div class="row input-toghter">
                                        <!-- start-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.startDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="startDate"
                                                required value="{{ old('startDate') }}">
                                        </div>

                                        <!-- end-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.endDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="endDate"
                                                    required value="{{ old('endDate') }}">
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
                                                 value="{{ old('decisionDate') }}">
                                        </div>

                                        <!-- decision-number field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.decisionNumber') }}
                                            </span>
                                            <input type="number" class="form-control" name="decisionNumber"
                                                 value="{{ old('decisionNumber') }}" min='1'>
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
                                                    @if (\Request::old('VacationType') == $vacationType)
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
                                                    required value="{{ old('yearNumber') }}" min='1'>
                                            </div>
                                    </div>

                                    <!-- Country field -->
                                    <div class="form-group">
                                        <select class="form-control specialSelect" name="countryName" required>
                                            <option selected hidden value="">{{ __('dataTypes.countryName') }}</option>

                                            @foreach ($countries as $country)
                                                @if (\Request::old('countryName') == $country)
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
