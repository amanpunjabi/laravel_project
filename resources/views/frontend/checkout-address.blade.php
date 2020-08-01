@extends('frontend.layout.master')
@section('content')
 @push('css')
 <link href='{{ asset("css/stripe.css") }}' rel="stylesheet">
 <script src="https://js.stripe.com/v3/"></script>
 
 @endpush

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			
			<div class="shopper-informations">
			<div class="row">
			   {{-- billing to address --}}
			   {{-- <div class="col-sm-6">
			   	<h2 class="title text-center">Bill To</h2>
						<div class="total_area">
							<ul>
								 
								 
								<li>First Name <span>{{ $user->firstname }}</span></li>
								<li>Last Name <span>{{ $user->lastname }}</span></li>
								<li>Email<span>{{ $user->email }}</span></li>
								<li>Phone<span>{{ $user->phone }}</span></li>
								<li>Address<span>{{ $address->address ?? '' }}</span></li>
								<li>City<span>{{ $address->city ?? '' }}</span></li>

								<li>State<span>{{ $address->state ?? '' }}</span></li>
								<li>Pincode<span>{{ $address->pincode ?? '' }}</span></li>
							</ul>
								 
						</div>
					</div> --}}
			    <div class="col-md-6">

	    			<div class="contact-form">
	    				
				    	
				    		<h2 class="title text-center">Bill To</h2>
				            <div class="form-group col-md-12">
				                <input type="text" id="firstname" class="form-control"  placeholder="First Name" value="{{ $user->firstname }}" readonly="readonly">
				                     

				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" id="lastname" class="form-control"  placeholder="Last Name" value="{{ $user->lastname }}" readonly="readonly">
				                
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" id="email" class="form-control"  placeholder="Email" value="{{ $user->email }}" readonly="readonly">
				                 
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" id="phone" class="form-control"  placeholder="Phone" value="{{ $user->phone }}" readonly="readonly">
				                
				            </div>
				            <div class="form-group col-md-12">
				                <textarea   id="address"  class="form-control" rows="8" placeholder="Address" readonly="readonly" >{{ $address->address ?? '' }}</textarea>
				               
				            </div>
				            
				            <div class="form-group col-md-12">
				                <input type="text" id="city" class="form-control"  placeholder="City" value="{{ $address->city ?? ''}}" readonly="readonly">
				              
				            </div>

			 	            <div class="form-group col-md-12">
				                <input type="text" id="state" class="form-control"  placeholder="State" value="{{ $address->state ?? ''}}" readonly="readonly">
				                
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" id="pincode" class="form-control"  placeholder="Pincode" value="{{ $address->pincode ?? '' }}" readonly="readonly">
				                 
				            </div>
 
	    			</div>
	    		</div>
	    		{{-- end billing to address --}}

	    		{{-- shipping address start --}}
	    		
	    		{{-- <form method="post"  action="#"> --}}
	    		<div class="col-md-6"> 
	    			<div class="contact-form">
	    				
	    				@if (Session::has('message'))
	    				<div class="status alert alert-success alert-dismissible">  
	    				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 					
       						{!! session('message') !!}
   						</div>
	    				@endif
				    	
				    		@csrf
				    		<h2 class="title text-center">Shipping To</h2>
				    		<div class="form-group col-md-12">
				    			<label class="checkbox-inline"><input type="checkbox" value="" id="sameBill">Same As Billing Address</label>
				    	</div>
				    		<form    method="post" action="{{ route('shipping.address')}}" id="payment-form" > 
				            <div class="form-group col-md-12">
				            	@csrf
				                <input type="text" name="firstname" class="form-control"  placeholder="First Name"  >
				                @error('firstname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     

				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="lastname" class="form-control"  placeholder="Last Name"  >
				                @error('lastname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="email" class="form-control"  placeholder="Email" >
				                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="phone" class="form-control"  placeholder="Phone"  >
				                @error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="address" id="message"  class="form-control" rows="8" placeholder="Address"  > </textarea>
				                @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            
				            <div class="form-group col-md-12">
				                <input type="text" name="city" class="form-control"  placeholder="City"  >
				                @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>

				            <div class="form-group col-md-12">
				                <input type="text" name="state" class="form-control"  placeholder="State"  >
				                @error('state')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>

				            <div class="form-group col-md-12">
				                <input type="text" name="pincode" class="form-control"  placeholder="Pincode"  >
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
				       </form>	 
				      
	    			</div>
	    		</div>
	    		{{-- end shipping address --}}
	
				 			
			</div>
			</div>

		</div>
	</section> <!--/#cart_items-->
@endsection
@push('js')
	<script type="text/javascript">
		$('#sameBill').click(function()
		{
			$('[name="firstname"]').val($('#firstname').val());
			$('[name="lastname"]').val($('#lastname').val());
			$('[name="email"]').val($('#email').val());
			$('[name="phone"]').val($('#phone').val());
			$('[name="address"]').html($('#address').html());
			$('[name="city"]').val($('#city').val());
			$('[name="state"]').val($('#state').val());
			$('[name="pincode"]').val($('#pincode').val());
		});
	</script>
    <script src='{{asset("js/stripe.js") }}'></script>
@endpush