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
                        <li class="list-group-item">User : <strong>{{ $resume->user->email }}</strong></li>
                        <li class="list-group-item">Resume : {{ $resume->name }}</li>
                        <li class="list-group-item">File Location : {{ $resume->location }}</li>
                    </ul>
                    <form method="post" target="_blank" action="{{ route('admin::dashboard.resume.file', ['file' => $resume->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="file_id" value="{{ $resume->original_name }}">
                        <input type="hidden" name="type" value="resumes">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                        <button class="btn btn-success pull-right">View Pdf</button>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>        
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Review the resume
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" action="{{ route('admin::dashboard.postReview') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                        <input type="hidden" name="user_id" value="{{ $resume->user_id }}">
                        <div class="clearfix">
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <label for="" class="control-label">General Remark</label>
                                   
                                </div>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" name="gen_remark" ></textarea>
                                </div>                                
                            </div>
                            <hr>
                            @foreach($parameters as $parameter)
                            <div class="row">
                            <div class="form-group col-sm-2">
                                <label class="control-label" for="inputSuccess">{{ $parameter->name }}</label>
                                <input type="number" class="form-control" name="parameter[{{ $parameter->id }}]" min="1" max="100" value="{{ $parameter->score }}">
                            </div>
                            <div class="form-group col-sm-10">
                                <label class="control-label">Remark</label>
                                <textarea class="form-control" name="remarks[]" id=""></textarea>
                            </div> 
                            </div>
                            @endforeach
                        </div> 
                        <div class="form-group">
                            <label class="control-label">Upload Report</label>
                            <input class="form-control" type="file" name="rep_file">
                        </div>
                        <input class="btn btn-info pull-right" type="submit" value="Save">                       
                    </form>                                               
                    
                </div>
                <!-- /.panel-body -->
            </div>                
        </div>
    </div>
</div>
@endsection