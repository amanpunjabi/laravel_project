@extends('frontend.layout.master')
@section('content')
{{-- @include('frontend.slider') --}}
{{-- @include('frontend.sidebar') --}}
<div class="col-sm-12 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php
								$imgname="";
								if(count($product->images) == 0){
								$imgname =  asset("frontend/images/404/404.png"); 
								}
								else{
								$imgname = $product->images[0]->image;
							    $imgname = asset('storage/'.$imgname);
 								}
								
								?>
							{{-- <img src="{{ asset('storage/'.$imgname) }}" style="height: 327px;width: 381px" /> --}}
							
						      <img class="img-fluid z-depth-1" src="{{ $imgname }}" alt="video"
						        >
			 
								<h3 data-toggle="modal" data-target="#modal1">ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
								    @foreach($product->images->chunk(3) as $images)
										<div class="item {{($loop->first)?'active':''}}">
										@foreach($images as $image)
										  <a href=""><img src="{{ asset('storage/'.$image->image) }}" alt="" style="height: 85px;width: 84px"></a>
										@endforeach 
										</div>
									@endforeach	
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product->name }}</h2>
								@if ($errors->any())
		                            <ul class="alert alert-danger">
		                                @foreach ($errors->all() as $error)
		                                    <li>{{ $error }}</li>
		                                @endforeach
		                            </ul>
		                        @endif
								<div class="form-inline" >
								{{-- @foreach($attributes as $key => $attribute)
								<div class="form-group">
								<select class="form-control" name="value_id[]">
									<option> select {{ get_attribute_name($key)}}</option>
									@foreach($attribute as $value)
									<option value="{{ $value }}">{{ get_attribute_value($value) }}</option>
									@endforeach
								</select>
								</div>
							 	@endforeach --}}
							 	

							 	</div>
								{{-- <p>Web ID: 1089772</p> --}}
								 
								<span>
								
									{{-- {{ dd($product->variant)}} --}}
									<form action="{{ route('cart.store') }}" method="POST" id="form_cart">
									<div class="form-group row">
									<div class="col-xs-6	">
									<?php 
									$variation_id = "";
									$variationqty = "1";
									?>

										@if($product->attribute_id != null) 
										<select class="form-control" name="attribute_id"  required onchange="loadVariant(this)">
										<option value=""> select {{ get_attribute_name($product->attribute_id)}}</option> 
										@foreach($attribute_values as $value)
										<option value="{{ $value['attribute_value'] }}" {{ (isset($product->variant->attribute_value) &&$product->variant->attribute_value==$value['attribute_value']?'selected':'')  }}>
										{{-- {{ get_attribute_value($value['attribute_value_id']) }} --}}
									{{ $value['attribute_value']}}</option>
										@endforeach
									    </select>
									@else
									<?php
									$variation = $product->variation()->first();
									 $variation_id = $variation->id;
									$variationqty = $variation->qty;
									?>
									<input type="hidden" name="attribute_id" value="na"> 
									@endif
									</div>
									{{-- @if("" == 0)
									{{dd()}}
									@endif --}}
									<input type="hidden" name="variation_id" value="{{ $variation_id ?? '' }}">
							</div>
										<span id="priceTag">US
											 {{ $price = getMinMax($product->id) ?? $product->price}}</span>
									{{-- <label>Quantity:</label>
									<input type="number" value="1" name="quantity" id="quantity" max="{{ $product->variant->quantity ?? ''}}" min="1" /> --}}

									<button type="submit" class="btn btn-fefault cart" id="add_cart" @if($variationqty == 0) disabled="disabled"@endif>
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
			                                        {{ csrf_field() }}
			                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
			                                        <input type="hidden" value="{{ $product->name }}" id="name" name="name">
			                                        <input type="hidden" value="{{$product->price }}" id="price" name="price">
			                                        <input type="hidden" value="{{ $imgname}}" id="img" name="img">
			                                        {{-- <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug"> --}}
			                                        
			                                        
			                        </form>
								</span>
								<p><b>Availability:</b> 
								@if($variationqty == 0)
								<span id="stockinfo" class="text-danger">Out Of Stock</span>
								@else
								<span id="stockinfo">In Stock</span>
								@endif
								</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b>{{ $product->brand->name ?? 'N/A' }}</p>
								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							 </div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					@include('frontend.modal.image')
</div>

@push('js')
<script type="text/javascript">
	// $('#add_cart').click(function()
	// {
	// 	$('#form_cart').submit();
	// });
	function loadVariant(e)
	{ 
	 
		$.ajax({
	        url: "{{asset('product-variation')}}",
	        type: 'POST',
	        data: {
	            "product_id":"{{ $product->id }}",
	            "attribute_id":"{{$product->attribute_id}}",
	            "attribute_value": e.value,
	           "_token": "{{ csrf_token() }}"
	        },
	        success: function (data) {
	        	var data = JSON.parse(data);
	        	if(data == null)
	        	{
	        		data = { quantity : "{{ $product->quantity}}",
	        		price : "{{ $price = getMinMax($product->id) ?? $product->price}}",
	        		id : ""}
	        		console.log(data);
	        	}
	        	
	        		if(data.quantity <= 0)
		        	{
		        		data.quantity = 0;
		        		// $('[name="quantity"]').val(0);
		        		$('#stockinfo').html("Out Of Stock").addClass('text-danger');
		        		$('#add_cart').attr('disabled','disabled');
		        		// $('[name="quantity"]').attr('disabled','disabled');
		        	}
		        	else
		        	{
		        		$('#add_cart').removeAttr('disabled');
		        		// $('[name="quantity"]').removeAttr('disabled');
		        		$('#stockinfo').html("In Stock").removeClass('text-danger');
		        	}
		        	$('#priceTag').html("US $ "+data.price);
		        	$('[name="variation_id"]').val(data.id);
		        	// $('[name="quantity"]').attr("max",data.quantity);
		        	 
		        
	        }

    	});
    }
</script>
@endpush
@endsection