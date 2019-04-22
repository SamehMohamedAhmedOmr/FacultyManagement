@extends('../layout.layout')


@section('PageContent')
    <!-- Page Content -->
<div>
    <div class="pt-5 justify-content-center item-lists discussionlist">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ __('Heading.Discussionslist') }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="discussion data-table">
                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th style="width:25%">{{ __('dataTypes.name') }}</th>
                                        <th style="width:45%">{{ __('dataTypes.discussionName') }}</th>
                                        <th style="width:15%" class='text-center'>{{ __('dataTypes.edit') }}</th>
                                        <th style="width:15%" class='text-center'>{{ __('dataTypes.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discussions as $discussion)
                                        <tr class="odd gradeX">
                                                <td>
                                                    <a href="{{ URL('discussion/'.$discussion->id) }}">
                                                        {{ $discussion->facultyMember->name }}
                                                    </a>
                                                </td>

                                                <td>{{ $discussion->discussionName }}</td>

                                                <td class="text-center">
                                                    <a href="{{ URL('discussion/'.$discussion->id.'/edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <a class='delete' style='cursor:pointer;' data-id='{{ $discussion->id }}' data-token="{{ csrf_token() }}">
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
    <!-- /.row -->
</div>

@endsection
