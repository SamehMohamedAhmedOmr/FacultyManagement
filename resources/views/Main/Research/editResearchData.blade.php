@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
        <!-- /.row -->
        <div class="row forms py-5">
            @include('../Main.messages')
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.editResearchData') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12">
                                <form role="form" method="POST" action="/research/{{ $research->id }}">
                                    @method('PUT')
                                    @csrf

                                    <!-- Member field -->
                                    <div class="form-group">
                                        <select class="form-control specialSelect" name="facultyMember" required>
                                            <option selected hidden value="">{{ __('dataTypes.selectMemeber') }}</option>

                                            @foreach ($members as $member)
                                                @if ($research->facultymemberId == $member->id)
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

                                    <!-- researchName field -->
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{  __('dataTypes.researchName') }}
                                        </span>
                                        <textarea class="form-control" rows="3" name="researchName"
                                                placeholder="{{ __('dataTypes.researchNamePlaceHolder') }}" required>{{ $research->researchName }}</textarea>
                                    </div>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            {{ __('dataTypes.magazine') }}
                                        </span>
                                        <input type="text" class="form-control" name="magazine"
                                            required value="{{ $research->magazine }}">
                                    </div>

                                    <!-- Publish Date and Place fields-->
                                    <div class="row input-toghter">
                                        <!-- Publish-date field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.publishDate') }}
                                            </span>
                                            <input type="date" class="form-control" name="publishDate"
                                                required value="{{ $research->publishDate }}">
                                        </div>

                                        <!-- Publish-place field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.publishPlace') }}
                                            </span>
                                            <input type="text" class="form-control" name="publishPlace"
                                                    required value="{{ $research->publishPlace }}">
                                        </div>
                                    </div>

                                    <!-- effectCoefficient and bonus field-->
                                    <div class="row input-toghter">
                                        <!-- effectCoefficient field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.effectCoefficient') }}
                                            </span>
                                            <input type="number" step="0.001" class="form-control" name="effectCoefficient"
                                                 value="{{ $research->effectCoefficient }}" required>
                                        </div>

                                        <!-- bonusValue field -->
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.bonusValue') }}
                                            </span>
                                            <input type="number" step="0.01" class="form-control" name="bonusValue"
                                                 value="{{ $research->bonusValue }}" required>
                                        </div>
                                    </div>

                                    <!-- participantsBonusValue field-->
                                    <div class="row input-toghter">
                                        <div class="form-group input-group col-lg-6 px-lg-2">
                                            <span class="input-group-addon">
                                                {{ __('dataTypes.participantsBonusValue') }}
                                            </span>
                                            <input type="number" class="form-control" name="participantsBonusValue"
                                                    required value="{{ $research->participantsBonusValue }}" min='1'>
                                            </div>
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
