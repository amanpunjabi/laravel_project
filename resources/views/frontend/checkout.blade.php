@extends('frontend.layout.master')
@section('content')
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
			    <div class="col-md-4  ">

	    			<div class="contact-form">
	    				
	    				@if (Session::has('message'))
	    				<div class="status alert alert-success alert-dismissible">  
	    				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 					
       						{!! session('message') !!}
   						</div>
	    				@endif
				    	<form id="shopper-info-form" class="contact-form row" name="contact-form" method="post" action="{{ route('profile.update')}}">
				    		@csrf
				    		<h2 class="title text-center">Bill To</h2>
				            <div class="form-group col-md-12">
				                <input type="text" name="firstname" class="form-control"  placeholder="First Name" value="{{ $user->firstname }}">
				                @error('firstname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     

				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="lastname" class="form-control"  placeholder="Last Name" value="{{ $user->lastname }}">
				                @error('lastname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="email" class="form-control"  placeholder="Email" value="{{ $user->email }}">
				                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
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
	    		{{-- end billing to address --}}

	    		{{-- shipping address start --}}
	    		<form    name="contact-form" method="post" action="{{ route('checkout.place.order')}}"> 
	    		<div class="col-md-4  ">
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
				                <input type="text" name="firstname" class="form-control"  placeholder="First Name" value="{{ $user->firstname }}">
				                @error('firstname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     

				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="lastname" class="form-control"  placeholder="Last Name" value="{{ $user->lastname }}">
				                @error('lastname')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="email" class="form-control"  placeholder="Email" value="{{ $user->email }}">
				                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
				            </div>
				            <div class="form-group col-md-12">
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

				             
				      
	    			</div>
	    		</div>
	    		{{-- end shipping address --}}

				<div class="col-md-4  ">
					<div class="order-message col-md-12">
						<p>Shipping Order</p>
						<textarea name="notes"  placeholder="Notes about your order, Special Notes for Delivery" rows="16" class=""></textarea>
						
					</div>	
					 
				            	<div class="payment-options col-md-12">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
					<input type="submit" class="btn btn-primary pull-right" value='checkout' />
				</div>
				            
				</div>	
				  </form>				
			</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			{{-- <div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/one.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/two.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td class="cart_product">
								<a href=""><img src="images/cart/three.png" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">Colorblock Scuba</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$59</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$59</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$59</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$61</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div> --}}
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@forelse($cartCollection as $item)
						<tr>
							{{-- {{ dd($item)}} --}}

							<td class="cart_product">
								<a href=""><img src="{{asset('storage/'.$item->options->image)}}" alt="" height="100px" width="100px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $item->name }}</a></h4>
								 
							</td>
							<td class="cart_price">
								<p>${{ $item->price }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$

									{{ $item->qty*$item->price }}
								</p>
			
							</td>
							<td class="cart_delete">
								{!! Form::open(['route' => 'cart.remove']) !!}

								{{ Form::hidden('rowId',$item->rowId)}}
    							<button type="submit" class="btn-primary" href=""><i class="fa fa-times"></i></button>


								{!! Form::close() !!}
																
							</td>
						</tr>
						@empty 
						 <tr><td colspan="4" class="text-center"><h4>No Product(s) In Your Cart</h4><td>
						 </tr>
						@endforelse
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{ Cart::subtotal() }}</td>
									</tr>
									<tr>
							 			<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{ Cart::total() }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			

		</div>
	</section> <!--/#cart_items-->
@endsection