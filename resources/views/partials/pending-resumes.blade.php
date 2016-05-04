    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Pending Resumes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                @if(!$pendingResumes->isEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                   {{--  <th></th>
                                    <th></th> --}}
                                    <th>File name</th>             
                                    <th>Location</th>
                                    <th>User email</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingResumes as $index => $resume)
                                <tr class="danger">
                                    <td>{{ ++$index }}</td>
                                   {{--  @if($resume->parent != 0)                                    
                                    <td></td><td><i class="fa fa-minus"></i></td>
                                    @else
                                    <td><i class="fa fa-plus"></i></td><td></td>
                                    @endif --}}
                                    
                                    <td>{{ $resume->name }}</td>
                                    <td>{{ $resume->location }}</td>
                                    <td>{{ $resume->user->email }}</td>
                                    <td>{{ $resume->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin::dashboard.edit.report', ['report' => $resume->report->id ]) }}" class="btn btn-sm btn-info">Drafted</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                @else
                    <h4>No pending reviews</h4>     
                @endif                     
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>