	@extends('frontend.layout.master')
	@section('content')
	<?php $countOutofStock = 0; ?>
		<section id="cart_items">
			<div class="container">
				<div class="breadcrumbs">
					<ol class="breadcrumb">
					  <li><a href="{{ route('homepage')}}">Home</a></li>
					  <li class="active">Shopping Cart</li>
					</ol>
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
								<td></td>
							</tr>
						</thead>
						<tbody>
							@forelse($cartCollection as $item)
							<tr>
							<?php 
							$str_attribute = "";
							$stockerr = "";
							$variation = App\ProductVariation::find($item->options->variation_id);
							if($variation!=null)
							{
								$str_attribute .=  "(".get_attribute_name($variation->attribute_id);
								$str_attribute .= ":".$variation->attribute_value.")";
								if($variation->quantity <=0)
								{
									$stockerr = "Out Of Stock";
									$countOutofStock++;
								}
							}
							?>

								<td class="cart_product">
									<a href=""><img src="{{asset('storage/'.$item->options->image)}}" alt="" height="100px" width="100px"></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $item->name }}{{ $str_attribute}}
								<span class="help-block">{{ $stockerr }}</span>
								</a></h4>
									 
								</td>
								<td class="cart_price">
									<p>${{ $item->price }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button" style="display: flex;" >
										<form action="{{ route('cart.update') }}" method="post"> 
											@csrf
											<input type="hidden" name="rowId" value="{{$item->rowId}}">
											<input type="hidden" name="type" value="minus">
											<button class="  btn-primary cart_quantity_up" type="submit"> - </button> 
										</form>
										<input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2" disabled="disabled" /> 
										<form action="{{ route('cart.update') }}" method="post"> 
											@csrf
											<input type="hidden" name="rowId" value="{{$item->rowId}}">
											<input type="hidden" name="type" value="plus"> 
											<button class="cart_quantity_up btn-primary" href=""> + </button> 
										</form>
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

						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->
		@if(\Cart::count() > 0)
		<section id="do_action">    
			<div class="container">
				<div class="heading">
					<h3>What would you like to do next?</h3>
					<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
				</div>
				<div class="row">
					     
					<div class="col-sm-8">
						<div class="total_area">
							<ul>
								 
								<li>Cart Sub Total <span>${{ Cart::subtotal(2,'.','') }}</span></li>
								@if(session()->get('coupon')!=null)
								<li>Discount ({{ session()->get('coupon')['code']??'N/A'}}) <form  method="post" action="{{route('destroyCoupon')}}" style="display: inline;"> 
									 @method('DELETE')
								@csrf
								 
								<button class="btn btn-link " type="submit" style="color: red">Remove coupon</button>
								</form><span>-${{ $discount }}</span>

								</li>
								<li>New Sub Total <span>${{ $newSubTotal }}</span></li>
								@endif

								<li>Eco Tax <span>{{ $newTax }}</span></li>
								<li>Shipping Cost <span>Free</span></li>
								<li>Total <span>${{ $newTotal }}</span></li>
							</ul>
						 	@if($countOutofStock > 0 )
						 	<a class="btn btn-default update" href="#" disabled>Check Out</a><span class="help-block">Note: Please Remove Out of stock Item from cart</span>
						 	@else	 
								<a class="btn btn-default update" href="/checkout-address" >Check Out</a>
							@endif
						</div>
					</div>
					<div class="col-sm-4">
						<div class="chose_area">
							<form method="post" action="{{route('storecoupon')}}"> 
							@csrf

							<ul>
								<li>
									@if ($errors->any())
	                            <ul class="alert alert-danger">
	                                @foreach ($errors->all() as $error)
	                                    <li>{{ $error }}</li>
	                                @endforeach
	                            </ul>
		                        @endif
								</li>
								<li class="single_field zip-field">
									<label>Have a Coupon Code:</label>
									<input type="text" class="form-control" name="coupon_code" id="coupon_code"  >
									 
								</li>
							</ul>
							<button class="btn btn-default update" type="submit">Apply</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->
		@endif


	@endsection