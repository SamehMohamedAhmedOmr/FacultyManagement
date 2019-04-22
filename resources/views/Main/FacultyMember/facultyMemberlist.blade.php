@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
<div>
    <div class="row pt-5 justify-content-center item-lists">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ __('Heading.FacultyMembers') }}
                </div>

                <div class="panel-body">
                    <div class="data-table facultyMember">
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th style="width:25%">{{ __('dataTypes.name') }}</th>
                                    <th style="width:45%">{{ __('dataTypes.job') }}</th>
                                    <th style="width:15%" class='text-center'>{{ __('dataTypes.edit') }}</th>
                                    <th style="width:15%" class='text-center'>{{ __('dataTypes.delete') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($members as $member)
                                    <tr class="odd gradeX">
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->job }}</td>
                                        <td class="text-center">
                                            <a href="{{ URL('facultyMember/'.$member->id.'/edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class='delete' style='cursor:pointer;' data-id='{{ $member->id }}'
                                                data-token="{{ csrf_token() }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

    <!-- /.row -->

@endsection
