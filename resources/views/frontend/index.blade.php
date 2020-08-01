@extends('frontend.layout.master')
@section('content')
@include('frontend.slider')
@include('frontend.sidebar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
					@foreach($featured_products->chunk(4) as $productChunk)
					<div class="row">
						@foreach($productChunk as $product)
						<?php 
						$price = getMinMax($product->id) ?? $product->price;
						?>
						 
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">	@if(count($product->images) == 0 )

											<img src="{{ asset("frontend/images/404/404.png")}}" alt="" />
											@else
											@foreach($product->images as $image)
											
											
											<img src="{{ asset('storage/'.$image->image) }}" alt="" />
											@break
											@endforeach
											@endif
											<h2>{{ $price }}</h2>
											<p>{{ $product->name }}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{ $price }}</h2>
												<p>{{ $product->name }}</p>
												<a href="{{ route('product_detail',$product->id)}}" class="btn btn-default add-to-cart">
												<i class="fa fa-eye"></i>View
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
			                                       {{--  <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> --}}
			                                    	</form>

													{{-- end add to cart form --}}
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{ route('add_wishlist',$product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div>
						@endforeach
					<ul class="pagination">
						<?php echo $featured_products; ?>
					</ul>
					</div><!--features_items-->
					<?php
					$featuredcategories = getfeaturedCategories(); 
					?>
					@if(count($featuredcategories) > 0)
						<div class="category-tab"><!--category-tab-->
							<div class="col-sm-12">
								<ul class="nav nav-tabs">
									<?php $i=0; ?> 
									 
									 
									@foreach($featuredcategories as $category)
									<?php 
									if($loop->first)
									{
										$featuredcatid = $category->id;
									}
									?>
									{{-- {{ dd($category)}} --}}
									{{-- <pre> --}}
									<?php 
									if(count($category->products)==0){
									continue;
									}
									if(count($category->products[0]->variation)==0){
											
											continue;
									    }
									?>
									<li class="{{($i == 0)?'active':''}}" ><a href="#{{ $category->id}}" data-toggle="tab" onclick="getContent({{$category->id}})">{{ $category->category_name }}</a></li>
									 <?php $i++; ?>
									@endforeach
								</ul>
							</div>
							<div class="tab-content" id="tab-content">
							</div>
						
					</div><!--/category-tab-->
					@endif

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide z-depth-1-half" data-ride="carousel">

							<div class="carousel-inner">
						    <?php $i =0; ?>
							@foreach($recommended_products->chunk(4) as $productChunk)
								<div class="item {{ ($i==0)?'active':''}}">
									@foreach($productChunk as $product)
									<?php 
									$price = getMinMax($product->id) ?? $product->price;
									?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">

													@if(count($product->images) == 0)
													<img src="{{ asset("frontend/images/404/404.png")}}" alt="" />
													@else
													@foreach($product->images as $image)
											
											
													<img src="{{ asset('storage/'.$image->image) }}" alt="" />
													@break
													@endforeach
													@endif
													<h2>{{ $price}} </h2>
													<p>{{ $product->name }}</p>
													<a href="{{ route('product_detail',$product->id)}}" class="btn btn-default add-to-cart">
												<i class="fa fa-eye"></i>View
												</a>
												<div class="choose">
													<ul class="nav nav-pills nav-justified">
														<li><a href="{{ route('add_wishlist',$product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
													</ul>
												</div>
												</div>

												
											</div>
										</div>

									</div>
									@endforeach
								</div>
							<?php $i++; ?>
							@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
@endsection

@push('js')
<script type="text/javascript">
	@if(isset($featuredcatid))
	$(document).ready(function() {

			cat_id = "{{ $featuredcatid }}";
			 
			 $.ajax({
	        url: "category/content/"+cat_id,
	        type: 'get',
	        success: function (data) {
	        	$('#tab-content').html(data);
		        
	        }

    	});
		});
	@endif
	function getContent(id)
	{
		cat_id = id;
			 
			 $.ajax({
	        url: "category/content/"+cat_id,
	        type: 'get',
	        success: function (data) {
	        	$('#tab-content').html(data);
		        
	        }

    	});
	}
</script>
@endpush