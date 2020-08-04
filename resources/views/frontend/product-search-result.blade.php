@extends('frontend.layout.master')  
@section('content')
{{-- @include('frontend.slider') --}}
@include('frontend.sidebar')
				{{-- {{dd(asset('/'))}} --}}
				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Search Result For {{$search}}</h2>
					@forelse($products->chunk(4) as $productChunk)
					<div class="row">
						@foreach($productChunk as $product)
						<?php 
						//if(count($product->attributes_values)==0){
						//	continue;
						//}
						?>
						 
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											@foreach($product->images as $image)
											
											
											<img src="{{ asset('storage/'.$image->image) }}" alt="" />
											@break
											@endforeach
											<h2>{{ $price = getMinMax($product->id) ?? $product->price}}</h2>
											<p>{{ $product->name }}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<a href="{{ route('product_detail',$product->id)}}"><h2>${{ $product->price }}</h2>
												<p>{{ $product->name }}</p>
												</a>
												{{-- add to cart form 		 --}}

													<form action="{{ route('cart.store') }}" method="POST">
			                                        {{ csrf_field() }}
			                                        <input type="hidden" value="{{ $product->id }}" id="id" name="id">
			                                        <input type="hidden" value="{{ $product->name }}" id="name" name="name">
			                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
			                                        <input type="hidden" value="{{ $image->image ?? ''}}" id="img" name="img">
			                                        {{-- <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug"> --}}
			                                        <input type="hidden" value="1" id="quantity" name="quantity">
			                                      {{--   <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> --}}
			                                    	</form>

													{{-- end add to cart form --}}
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{ route('add_wishlist',$product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					@empty
					<h3 class="title text-center">No Product Found For {{$search}}</h3>
						@endforelse
					<ul class="pagination">
						<?php echo $products; ?>
					</ul>
					</div><!--features_items-->
					
					
					
				</div>
@endsection    