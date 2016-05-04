@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Edit Parameter
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form method="post" action="{{ route('admin::dashboard.update.parameter') }}">
                        {{ csrf_field() }}                       
                        <div class="form-group">
                            <label class="control-label">Paramter Name</label>
                            <input type="hidden" name="p_id" value="{{ $parameter->id }}">
                            <input class="form-control" type="text" name="p_name" value="{{ $parameter->name }}">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-info pull-right" type="submit" value="Update">
                        </div>
                    </form>                                                                   
                </div>
                <!-- /.panel-body -->
            </div>                            
        </div>
    </div>
</div>
@endsection