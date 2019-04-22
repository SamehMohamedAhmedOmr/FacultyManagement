@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->

    <div class="row pt-5 justify-content-center item-lists researchlist">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.Researchlist') }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="data-table research">
                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th style="width:25%">{{ __('dataTypes.name') }}</th>
                                        <th style="width:45%">{{ __('dataTypes.researchName') }}</th>
                                        <th style="width:10%" class='text-center'>{{ __('dataTypes.edit') }}</th>
                                        <th style="width:10%" class='text-center'>{{ __('dataTypes.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($researches as $research)
                                        <tr class="odd gradeX">
                                                <td>
                                                    <a href="{{ URL('research/'.$research->id) }}">
                                                        {{ $research->facultyMember->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $research->researchName }}</td>
                                                <td class="text-center">
                                                    <a href="{{ URL('research/'.$research->id.'/edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class='delete' style='cursor:pointer;' data-id='{{ $research->id }}' data-token="{{ csrf_token() }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@endsection
