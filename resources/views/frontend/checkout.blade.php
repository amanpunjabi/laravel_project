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
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

	 
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							 
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
								{{-- <div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div> --}}
								{{$item->qty}}
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$

									{{ $item->qty*$item->price }}
								</p>
			
							</td>
							 
						</tr>
						@empty 
						 <tr><td colspan="4" class="text-center"><h4>No Product(s) In Your Cart</h4><td>
						 </tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<table class="table">
									<tr>
								<td></td>
								<td>
							 	<h4>Address:</h4><br>
								<p> 
								{{$address->address}}<br>
								{{$address->city }}<br>
								{{$address->state }} - {{$address->pincode }}<br>
								{{$address->phone }}
							</p>
								</td>
							</tr>
							</table>
				</div>
				<div class="col-sm-6">
				<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{ Cart::subtotal(2,'.','')}}</td>
									</tr>
									@if(session()->get('coupon')!=null)
									<tr>
										<td>Discount ({{ session()->get('coupon')['code']??'N/A'}})</td>
										<td>-${{ $discount }}</td>
									</tr>
									<tr>
										<td>New Sub Total </td>
										<td>${{ $newSubTotal }}</td>
									</tr>
									@endif
									<tr>
							 			<td>Exo Tax</td>
										<td>${{ $newTax }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td>${{ $newTotal }}</td>
									</tr>
									<tr>
										<td>
												<form  method="POST" action="{{ route('checkout.place.order')}}" id="payment-form" > 
									@csrf
									<div class="order-message col-md-12">
									<p>Payment Details</p>			
									</div>
									<div class="form-group">
									<label>Name on card:</label>
									<input type="text" name="cardname" class="form-control" />
									</div>

									<div class="form-row">
									<label for="card-element">
									  Credit or debit card
									</label>
									<div id="card-element">
									  <!-- A Stripe Element will be inserted here. -->
									</div>

									<!-- Used to display form errors. -->
									<div id="card-errors" role="alert" class="text-danger"></div>
										</div>

										<button type="submit" class="form-control btn-primary" id="submit_payment">Submit Payment</button>
									</form>
										</td>
									</tr>

								</table>
				</div>

			</div>


		</div>
	</section> <!--/#cart_items-->
@endsection
@push('js')

    <script src='{{asset("js/stripe.js") }}'></script>
@endpush