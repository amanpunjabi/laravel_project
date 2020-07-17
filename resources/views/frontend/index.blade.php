@extends('frontend.layout.master')
@section('content')
@include('frontend.slider')
@include('frontend.sidebar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
					@foreach($featured_products->chunk(3) as $productChunk)
					<div class="row">
						@foreach($productChunk as $product)
						<?php 
						//if(count($product->attributes_values)==0){
						//	continue;
						//}
						?>
						 
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											@foreach($product->images as $image)
											
											
											<img src="{{ asset('storage/'.$image->image) }}" alt="" />
											@break
											@endforeach
											<h2>${{ $product->price }}</h2>
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
			                                        <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
						@endforeach
					<ul class="pagination">
						<?php echo $featured_products; ?>
					</ul>
					</div><!--features_items-->
					
						<div class="category-tab"><!--category-tab-->
							<div class="col-sm-12">
								<ul class="nav nav-tabs">
									<?php $i=0; ?> 
									@foreach(getCategories() as $category)
									{{-- <pre> --}}
									<?php 
									if(count($category->products)==0){
									continue;
									}
									?>
									<li class="{{($i == 0)?'active':''}}" ><a href="#{{ $category->id}}" data-toggle="tab">{{ $category->category_name }}</a></li>
									 <?php $i++; ?>
									@endforeach
								</ul>
							</div>
						<div class="tab-content">
						 	<?php $i=0; ?>
							@foreach(getCategories() as $category)
							<?php 
							if(count($category->products)==0){
							continue;
							}
							?>

							<div class="tab-pane fade {{($i == 0)?'active':''}} in" id="{{ $category->id}}" >
							<?php $i++; ?>
								{{-- <pre> --}}
								<?php //print_r($category->products); ?>
							@foreach($category->products as $product)

								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												{{-- {{ dd($product->images[0]->image)}} --}}
												<?php
												$imgname="";
													if(isset($product->images[0]))
													{

													 $imgname = 'storage/'.$product->images[0]->image;
													}
												 ?>
												<img src="{{ asset($imgname) }}" />
												<h2>${{ $product->price}} </h2>
												<p>{{ $product->name}} </p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div> 
					 
							@endforeach
							</div>
							@endforeach

						</div>
					</div><!--/category-tab-->
					

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide z-depth-1-half" data-ride="carousel">

							<div class="carousel-inner">
						    <?php $i =0; ?>
							@foreach($recommended_products->chunk(3) as $productChunk)
								<div class="item {{ ($i==0)?'active':''}}">
									@foreach($productChunk as $product)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													@foreach($product->images as $image)
											
											
													<img src="{{ asset('storage/'.$image->image) }}" alt="" />
													@break
													@endforeach
													<h2>${{ $product->price}} </h2>
													<p>{{ $product->name }}</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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