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
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->profile->first_name }}</td>
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
                    Resumes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="timeline">
                        @foreach($user->resumes as $resume)
                        <li class="timeline-inverted">                            
                            @if( $resume->review_id === 1 )
                                <div class="timeline-badge danger">        
                            @elseif( $resume->review_id === 2 )
                                <div class="timeline-badge info">       
                            @else
                                <div class="timeline-badge success">
                            @endif
                                <i class="fa fa-check"></i>                                                        
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ $resume->name }}</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ $resume->created_at }} by {{ $user->email }}</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <form method="post" target="_blank" action="{{ route('admin::dashboard.resume.file', ['file' => $resume->id]) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="file_id" value="{{ $resume->original_name }}">
                                        <input type="hidden" name="type" value="resumes">
                                    @if( $resume->review_id == 1 )
                                        <a href="{{ route('admin::dashboard.review', ['resume' => $resume->id ]) }}" class="btn btn-sm btn-danger pull-right">Review</a>                                        
                                    @elseif( $resume->review_id == 2 )
                                        <a href="{{ route('admin::dashboard.edit.report', ['report' => $resume->report->id ]) }}" class="btn btn-sm btn-info pull-right">Drafted</a>
                                    @else
                                        <button class="btn btn-sm btn-success pull-left">View Pdf</button>
                                        <a class="btn btn-sm btn-success pull-right">Reviewed</a>
                                    @endif
                                    </form>                                                                      
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                     <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
</div>
@endsection
