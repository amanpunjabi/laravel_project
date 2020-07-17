@extends('frontend.layout.master')
@section('content')
{{-- @include('frontend.slider') --}}
@include('frontend.sidebar')
<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php
								$imgname="";
								if(isset($product->images[0]))
								{

								 $imgname = $product->images[0]->image;

								}
								?>
							{{-- <img src="{{ asset('storage/'.$imgname) }}" style="height: 327px;width: 381px" /> --}}
							
						      <img class="img-fluid z-depth-1" src="{{ asset('storage/'.$imgname) }}" alt="video"
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
										<select class="form-control" name="attribute_id"  required onclick="loadVariant(this)">
										<option value=""> select {{ get_attribute_name($product->attribute_id)}}</option>
										@foreach($attribute_values as $value)
										<option value="{{ $value['attribute_value_id'] }}" {{ (isset($product->variant->attribute_value_id) &&$product->variant->attribute_value_id==$value['attribute_value_id']?'selected':'')  }}>
										{{ get_attribute_value($value['attribute_value_id']) }}</option></a>
										@endforeach
									    </select>
									</div>
							</div>
										<span>US $
											{{ $product->variant->price ?? $product->price }}</span>
									<label>Quantity:</label>
									<input type="text" value="1" name="quantity" id="quantity" />

									<button type="submit" class="btn btn-fefault cart" id="add_cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
			                                        {{ csrf_field() }}
			                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
			                                        <input type="hidden" value="{{ $product->name }}" id="name" name="name">
			                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
			                                        <input type="hidden" value="{{ $imgname}}" id="img" name="img">
			                                        {{-- <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug"> --}}
			                                        
			                                        
			                        </form>
								</span>
								<p><b>Availability:</b>  In Stock</p>
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
		window.location = "<?php echo asset('/product-detail/'.$product->id.'/') ?>/"+e.value;
	}
</script>
@endpush
@endsection