@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">  
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>         
                            <th>User</th>
                            <th>Resume Name</th>                                    
                            <th>Score</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $report->user->email }}</td>
                            <td>{{ $report->resume->name }}</td>
                            <td>{{ $report->score }}</td>
                            <td>{{ $report->gen_remark }}</td>
                        </tr>
                    </tbody>
                </table>                            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    report
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>         
                                    <th>Parameter</th>                                 
                                    <th>Remark</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0; ?>
                            @foreach( $report->parameters as $index => $parameter)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $parameter->name }}</td>                                    
                                    <td>{{ $parameter->pivot->remark }}</td>
                                    <td>{{ $parameter->pivot->score }}</td>
                                </tr>
                                <?php $total+= $parameter->pivot->score; ?>
                            @endforeach
                                <tr class="success">
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ $total }}</strong></td>
                                </tr>
                                <tr class="danger">
                                    <td></td>
                                    <td>Report File</td>
                                    <td>{{ $report->file ? $report->file : 'Yet to Attach' }}</td>
                                    <td>
                                    @if($report->file)
                                    <form method="post" target="_blank" action="{{ route('admin::dashboard.report.file', ['file' => $report->id]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="file_id" value="{{ $report->file }}">
                                        <input type="hidden" name="type" value="reports">
                                        <button class="btn btn-success pull-right">View Pdf</button>
                                    </form>                                    
                                    @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                        @if($report->resume->review->name == "reviewing")
                        <a class="btn btn-danger pull-right" href="{{ route('admin::dashboard.edit.report',[$report->id]) }}">Edit</a>
                        @endif
                    </div>                    
                </div>
                <!-- /.panel-body -->
                <div class="well">
                @if($report->resume->review->name == 'reviewed')                
                <h6>Report Submitted to User</h6>                     
                @else
                    <form action="{{ route('admin::dashboard.generate.report') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="resume_id" value="{{ $report->resume->id }}">
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <input class="btn btn-danger btn-sm" type="submit" value="Generate Report" {{ $report->file ? '' : 'disabled' }}>
                        <small> Generate once all edits are done and report file is attached. </small>
                    </form>                
                @endif
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection