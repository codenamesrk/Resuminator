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

                @if($user->has_uploaded)
                <h2>Resume status</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, illo ipsa, necessitatibus.</p>
                <br>
                <h4>Uploaded Resumes</h4>
                @if(!empty($resume_reports))
                <ul class="list-group text-left">
                    @foreach($resume_reports as $res_rep)
                    <li class="list-group-item">                        
                        @if($res_rep->review_id < 3)
                        <span class="badge fail">
                        {{ $res_rep->review_id == 1 ? 'Pending Review' : 'Processing' }}
                        </span>
                        @else
                        <span class="badge success">
                        {{ $res_rep->review_id == 3 ? 'Reviewed. Need corrections' : 'Perfect' }}
                        </span>
                        @endif
                        {{ $res_rep->name }}
                    </li>

                    @if( $res_rep->report_id)
                    <li class="list-group-item success">                                                
                        <a href="{{ route('user::report',[ $res_rep->report_id ]) }}" class="badge success btn btn-success" >
                            Report of {{ $res_rep->name }}
                        </a>
                        <span class="glyphicon glyphicon-ok"></span> Report
                    </li> 
                    @endif

                    @endforeach
                @else
                <h4>Nothing to show</h4>
                @endif
                <br>

               {{--  <div class="alert alert-success" role="alert">Well done! Fire away your resume to grab your dream job. All the best.</div>
                <br>
                <a href="payment.html" class="btn btn-danger">Upload a new resume</a> --}} 
                @else
                <h4>Uupload resume</h4>
                @endif          
            </div>
        </div>
                              
    </div>
</div><!-- /headerwrap -->
@endsection