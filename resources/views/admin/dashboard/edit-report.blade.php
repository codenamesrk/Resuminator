@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Resume Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">User : <strong>{{ $report->user->email }}</strong></li>
                        <li class="list-group-item">Resume : {{ $report->name }}</li>
                        <li class="list-group-item">File Location : {{ $report->location }}</li>
                    </ul>
                    <form method="post" target="_blank" action="{{ route('admin::dashboard.resume.file', ['file' => $report->resume->original_name]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="resumes">
                        <input type="hidden" name="file_id" value="{{ $report->resume->original_name }}">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                        <button class="btn btn-success pull-right">View Pdf</button>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>        
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Review the resume
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" action="{{ route('admin::dashboard.save.report') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="clearfix">
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="" class="control-label">General Remark</label>
                                    
                                </div>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" name="gen_remark">{{ $report->gen_remark }}</textarea>
                                </div>                                
                            </div>
                            <hr>                        
                            @foreach($report->parameters as $parameter)
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label class="control-label" for="inputSuccess">{{ $parameter->name }}</label>
                                    <input type="number" class="form-control" name="parameter[]" min="1" max="100" value="{{ $parameter->pivot->score }}">
                                </div>
                                <div class="form-group col-sm-10">
                                    <label class="control-label">Remark</label>
                                    <textarea class="form-control" name="remarks[]">{{ $parameter->pivot->remark }}</textarea>                                  
                                </div>
                            </div>                              
                            @endforeach
                            <div class="form-group">
                                <label class="control-label">Upload Report</label>
                                <input class="form-control" type="file" name="rep_file">
                            </div>
                        </div> 
                        <input class="btn btn-info pull-right" type="submit" value="Save">
                    </form>                                                                   
                </div>
                <!-- /.panel-body -->
            </div> 
{{--             <div class="well">
                <form action="{{ route('admin::dashboard.generate.report') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="resume_id" value="{{ $report->resume->id }}">
                    <input type="hidden" name="report_id" value="{{ $report->id }}">
                    <input class="btn btn-danger btn-sm" type="submit" value="Generate Report">
                    <small> Generate once all edits are done. </small>
                </form>
            </div>  --}}                          
        </div>
    </div>
</div>
@endsection