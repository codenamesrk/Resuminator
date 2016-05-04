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

         <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
            <div class="text-center bs-wizard-stepnum">Share</div>
            <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
         </div>

         <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
            <div class="text-center bs-wizard-stepnum">Upload Resume</div>
            <div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
            <a href="#" class="bs-wizard-dot"></a>
         </div>
      </div>
      <div class="row row-centered">
         <div class="col-sm-6 col-centered text-center">
            <h2>Find People you know.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit dolore nihil consectetur voluptate ea omnis eaque soluta, excepturi recusandae modi quos quisquam, similique at, illo in quis possimus quia iste.</p>
            <a href="resume-views/share.html" class="btn btn-primary">
               <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>  Facebook</a>
               <a href="{{ route('user::google.import') }}" class="btn btn-danger">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Gmail</a>
               </div>
            </div>
            <div class="row row-centered">
               <div class="col-sm-6 col-centered">
                  <div class="row">
                   <hr>
                   <div class="col-sm-8 text-left">
                    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque aperiam aspernatur adipisci debitis.</small>
                 </div>
                 <div class="col-sm-4">
                    <a class="btn btn-default" href="{{ route('user::upload.resume') }}">Skip this step</a>
                 </div>                    
              </div>
           </div>
      </div>                                        
   </div>
</div><!-- /headerwrap -->
@endsection