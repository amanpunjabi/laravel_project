@extends('frontend.layout.master')
@section('content')
<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Profile</h2>    			    				    				
					{{-- <div id="gmap" class="contact-map"> --}}
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Personal Details</h2>
	    				@if (Session::has('message'))
	    				<div class="status alert alert-success alert-dismissible">  
	    				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 					
       						{!! session('message') !!}
   						</div>
	    				@endif
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{ route('profile.update')}}">
				    		@csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="firstname" class="form-control"  placeholder="First Name" value="{{ $user->firstname }}">
				                @error('firstname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     

				            </div>
				            <div class="form-group col-md-6">
				                <input type="text" name="lastname" class="form-control"  placeholder="Last Name" value="{{ $user->lastname }}">
				                @error('lastname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-6">
				                <input type="text" name="email" class="form-control"  placeholder="Email" value="{{ $user->email }}">
				                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-6">
				                <input type="text" name="phone" class="form-control"  placeholder="Phone" value="{{ $user->phone }}">
				                @error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="address" id="message"  class="form-control" rows="8" placeholder="Address"  >{{ $address->address ?? '' }}</textarea>
				                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            
				            <div class="form-group col-md-12">
				                <input type="text" name="city" class="form-control"  placeholder="City" value="{{ $address->city ?? ''}}">
				                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>

				            <div class="form-group col-md-12">
				                <input type="text" name="state" class="form-control"  placeholder="State" value="{{ $address->state ?? ''}}">
				                @error('state')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>

				            <div class="form-group col-md-12">
				                <input type="text" name="pincode" class="form-control"  placeholder="Pincode" value="{{ $address->pincode ?? '' }}">
				                @error('pincode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>

				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Change Password</h2>
	    				 
	    				  
				        <form method="POST" action="{{ route('changepassword') }}">
                        @csrf 
                        <div class="form-group col-md-12">
				                <input type="text" name="current-password" class="form-control @error('current-password') is-invalid @enderror"  placeholder="Current Password">
				            	
				            	@error('current-password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     
				            </div>    
				            <div class="form-group col-md-12">
				                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="New Password">
				            	
				            	@error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     
				            </div>
				         	<div class="form-group col-md-12">
				                
				                <input type="text" name="password_confirmation" class="form-control"   placeholder="Confirm Password">
				            </div>
				            </div>                          
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
@endsection