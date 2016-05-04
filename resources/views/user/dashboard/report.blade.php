@extends('layouts.user-app')

@section('user-info')
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">                
        <a href="#" class="dropdown-toggle bg-transp" data-toggle="dropdown" aria-expanded="false"><img src="{{ asset('img/pic1.jpg') }}" height="30" width="30" alt="">{{ $user->profile->first_name }} <span class="caret"></span></a>
    
        <ul class="dropdown-menu" role="menu">
            <li><a href="#"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
        </ul>        
    </li>
</ul>
@endsection

@section('content')
<div id="processwrap">
    <div class="container">             
        <div class="row row-centered">
            <div class="col-sm-6 col-centered text-center">
                <h4><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4>
                <h2>Resume Report</h2>
                <p>{{ $report->gen_remark }}</p>
                <br>
                <h4>Score Breakdown</h4>
               
                <ul class="list-group text-left">
                    @foreach($report->parameters as $param)
                    <li class="list-group-item">
                        <span class="badge success">{{ $param->pivot->score }}</span>
                        {{ $param->name }}
                    </li>
                    @endforeach
                    <li class="list-group-item success">
                        <span class="badge danger">{{ $report->score }}</span>
                        <strong>Total</strong>
                    </li>
                <br>

                <form method="post" target="_blank" action="{{ route('user::report.file', ['file' => $report->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="file_id" value="{{ $report->file }}">
                    <input type="hidden" name="type" value="reports">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                    <button class="btn btn-success pull-right">View Detailed Report</button>
                </form>                


               {{--  <div class="alert alert-success" role="alert">Well done! Fire away your resume to grab your dream job. All the best.</div>
                <br>
                <a href="payment.html" class="btn btn-danger">Upload a new resume</a> --}}           
            </div>
        </div>
                              
    </div>
</div><!-- /headerwrap -->
@endsection