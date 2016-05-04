@extends('layouts.user-app')

@section('user-info')
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#UserLogin">Already a member?</a></li>
    </ul>
@endsection

@section('content')
    <div id="headerwrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <h1>Get your resume validated by the experts</h1>
                    
                      <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#RegisterLogin">Validate Now</button>
                    
                </div><!-- /col-lg-6 -->
                <div class="col-md-4 col-lg-4 rs-fig">
                    <img class="img-responsive" src="{{ asset('img/ipad-hand.png') }}" alt="">
                </div><!-- /col-lg-6 -->
                
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /headerwrap -->

    <!-- Modal -->
    <div class="modal fade" id="RegisterLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Resuminator</h4>
                <h5 class="">Stop waiting. Get your resume validated and grab your dream job.</h5>
            </div>
            <div class="modal-body">
                <div class="social-login text-center">
                    <button class="btn btn-lg btn-success">Continue with Facebook</button>
                </div>
                <br>
                <center><small> or </small></center>
                <br>
                <div class="row text-center">
                    <a class="btn btn-lg btn-info" href="{{ route('user::register') }}">Sign Up</a>
                </div>
{{--                 <div class="row row-centered">
                    <div class="col-sm-6 col-centered">
                        <form action="{{ route('user::register') }}" method="get">
                            <div class="form-group">                       
                                <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Email">
                                {{ method_field('DELETE') }}
                            </div>
                            <div class="form-group">                       
                                <input type="password" name="pass" class="form-control" id="loginPassword" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning btn-lg btn-block" value="Sign Up">
                            </div>
                            <div class="form-group text-center">
                                <small>Signing up means you're OK with our</small>
                                <br>
                                <small>Terms of Service and Privacy Policy</small>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
      </div>
    </div>
        <!-- Modal -->
    <div class="modal fade" id="UserLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Resuminator</h4>
                <h5 class="">Log in and get closer to your dream job.</h5>
            </div>
            <div class="modal-body">
                <div class="social-login text-center">
                    <a class="btn btn-lg btn-success" href="payment.html">Login with Facebook</a>
                </div>
                <br>
                <center><small> or </small></center>
                <br>
                <div class="row row-centered">
                    <div class="col-sm-6 col-centered">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}
                            <div class="form-group">                       
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                            <div class="form-group">                       
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-left">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>                            
                            <div class="form-group clearfix">
                                
                                <div class="col-md-6 text-left">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                    </button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection