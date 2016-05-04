@extends('layouts.user-app')

@section('user-info')
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
		<form role="form" action="{{ route('user::register.post.profile', ['id' => $id ]) }}" method="post">
			<div class="row row-centered">
				<div class="col-sm-6 col-centered text-center">
					<h2>New User</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					{{ csrf_field() }}
					<input type="hidden" name="user_id" value="{{ $id }}">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
							</div>
						</div>
					</div>

					<div class="form-group">
						<input type="text" name="mobile" id="mobile" class="form-control input-lg" placeholder="Phone No." tabindex="4">
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