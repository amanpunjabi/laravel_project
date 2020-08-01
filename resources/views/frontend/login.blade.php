@extends('frontend.layout.master')
@section('content')
@if(auth()->check())
<script>window.location = "/";</script>
@endif
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0&appId=597669324496756&autoLogAppEvents=1" nonce="ocmxW0Oh"></script>
@push('css')
<style type="text/css">
	.btn-facebook {
    color: #fff;
    background-color: #3b5998;
    border-color: rgba(0,0,0,0.2);
}

.btn-google {
    color: #fff;
    background-color: #CF3E3A;
    border-color: rgba(0,0,0,0.2);
}

.btn-social {
    position: relative;
    padding-left: 44px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-social:hover {
    color: #eee;
}

.btn-social :first-child {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 40px;
    padding: 7px;
    font-size: 1.6em;
    text-align: center;
    border-right: 1px solid rgba(0,0,0,0.2);
}
</style>
@endpush
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action='{{ route('login') }}' method="post">
							@csrf
							<div>
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="email">

                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="current-password" placeholder="password">

                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
							 
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>

							<button type="submit" class="btn btn-default">Login</button>
							<a href="{{ route('password.request') }}" >Forgot your password?</a>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-3">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('register') }}" method="post">
							 @csrf
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" placeholder="name">

                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="email">

                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                 <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="confirm password">

							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-3">
				<div class="signup-form">	
				<h2>Social Login!</h2>
                <div>
                     
    				  <a href="{{url('/redirect')}}" class="btn btn-lg btn-social btn-facebook"> <i class="fa fa-facebook "></i> Facebook
       				  </a> 
                      <a href="{{url('/google/redirect')}}" class="btn btn-lg btn-social btn-google"> <i class="fa fa-google"></i> Google
                      </a>
    				 
                </div>
				</div>
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection