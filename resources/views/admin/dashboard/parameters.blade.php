@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Parameters</div>

                <div class="panel-body">
                   <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>           
                                    <th>Title</th>                                  
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parameters as $index => $parameter)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $parameter->name }}</td>                                  
                                    <td>{{ $parameter->created_at }}</td>
                                    <td><a href="{{ route('admin::dashboard.edit.parameter', [ 'parameter' => $parameter->id ]) }}" class="btn btn-sm btn-info">Edit</a></td>
                                    <form class="param" id="param-{{ $parameter->id }}" action="{{ route('admin::dashboard.delete.parameter', [ 'id' => $parameter->id ]) }}" method="post">
                                    {!! csrf_field() !!}
                                    {{ method_field('DELETE') }}
                                    <td><button type="submit" class="btn btn-sm btn-danger delete-button">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

 <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-danger">
            <div class="panel-heading">Create New Parameter</div>

            <div class="panel-body">
                <form action="{{ route('admin::dashboard.save.parameter') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" class="form-control" name="p_name" placeholder="Parameter Name">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection
