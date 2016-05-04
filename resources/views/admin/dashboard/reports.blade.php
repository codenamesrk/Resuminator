@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reports
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>           
                                    <th>Resume Name</th>
                                    <th>Score</th>                                    
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $index => $report)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $report->resume->name }}</td>
                                    <td>{{ $report->score }}</td>                                    
                                    <td>{{ $report->created_at }}</td>
                                @if( $report->resume->review->name === 'reviewing' )
                                    <td>Draft</td>
                                    <td><a href="{{ route('admin::dashboard.showReport', ['route' => $report->id]) }}" class="btn btn-sm btn-danger">View</a></td>
                                @else
                                    <td>Completed</td>
                                    <td><a href="{{ route('admin::dashboard.showReport', ['route' => $report->id]) }}" class="btn btn-sm btn-success">View</a></td>
                                @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
</div>
@endsection