@extends('layouts.user-app')

@section('user-info')
@endsection

@section('content')
<div id="processwrap">
	<div class="container">		        
		<div class="row bs-wizard" style="border-bottom:0;">

			<div class="col-xs-3 bs-wizard-step active">
				<div class="text-center bs-wizard-stepnum">Registration</div>
				<div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
				<a href="#" class="bs-wizard-dot"></a>            
			</div>

			<div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
				<div class="text-center bs-wizard-stepnum">Payment</div>
				<div class="progress progress-striped active"><div class="progress-bar progress-bar-warning"></div></div>
				<a href="payment.html" class="bs-wizard-dot"></a>
			</div>

			<div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
				<div class="text-center bs-wizard-stepnum">Share</div>
				<div class="progress"><div class="progress-bar"></div></div>
				<a href="#" class="bs-wizard-dot"></a>
			</div>

			<div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
				<div class="text-center bs-wizard-stepnum">Upload Resume</div>
				<div class="progress"><div class="progress-bar"></div></div>
				<a href="#" class="bs-wizard-dot"></a>
			</div>
		</div>
		<form role="form" action="{{ route('user::post.register') }}" method="post">
			<div class="row row-centered">
				<div class="col-sm-6 col-centered text-center">
					<h2>New User</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					{{ csrf_field() }}
					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" tabindex="4" placeholder="johndoe@rambo.com">
					</div> 

					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="6">
					</div>

					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>

					<div class="form-group text-left">
						<span class="button-checkbox">           
			   				<input type="checkbox" name="t_and_c" id="t_and_c"> I agree with the terms and conditions
			   			</span>						
					</div>

					<div class="form-group">
						<input type="submit" value="Register" class="btn btn-success btn-block btn-lg" tabindex="7">
					</div>
	        	</div> 
	   		</div>
		</form>                	
	</div>
</div>                                        
<!-- /processrwrap -->
@endsection