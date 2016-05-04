@extends('layouts.user-app')

@section('user-info')
<ul class="nav navbar-nav navbar-right">
	<li>            	
		<a href="#"><img src="{{ asset('img/pic1.jpg') }}" height="30" width="30" alt="">{{ $user->profile->first_name }}</a>
	</li>
</ul>
@endsection

@section('content')
  <div id="processwrap">
    <div class="container">           
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Registration</div>
                  <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>            
                </div>
                
                <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Payment</div>
                  <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
                  <a href="payment.html" class="bs-wizard-dot"></a>
                </div>
                
                <div class="col-xs-3 bs-wizard-step complete"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Share</div>
                  <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
                  <a href="share.html" class="bs-wizard-dot"></a>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Upload Resume</div>
                  <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                </div>
            </div>
            <div class="row row-centered">
                <div class="col-sm-6 col-centered text-center">
                  <h2>Almost there.</h2>
                  <p>Upload your resume lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias ab, quis odio itaque sit facere.</p>
                 <form action="{{ route('user::submit.resume') }}" method="post" enctype="multipart/form-data">
                 {!! csrf_field() !!}

                    <span id="fileselector">
                        <label class="btn btn-danger" for="upload-file-selector">
                            <input id="upload-file-selector" name="resume_file" type="file" class="btn btn-primary" onchange="this.form.submit()">
                            <span class="glyphicon glyphicon-cloud-upload font-correct" aria-hidden="true">Upload</span>                        
                        </label>
                    </span>
                </form>                 
                </div>
           </div>
                                       
    </div>
  </div><!-- /headerwrap -->
@endsection