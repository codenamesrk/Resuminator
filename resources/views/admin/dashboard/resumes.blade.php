@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ isset($allResumes) ? 'Resumes' : 'New Resumes' }}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    @if(!$resumes->isEmpty())
                        @include('partials.all-resumes')
                    @else
                        Nothing to show!
                    @endif
                        <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    
    @if( isset($pendingResumes))
        @include('partials.pending-resumes')
    @endif
</div>
@endsection