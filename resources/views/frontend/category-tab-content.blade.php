<div class="tab-pane  active" id="{{ $category->id}}" > 
 
@foreach($category->products as $product)
<?php 
if(count($product->variation)==0){
	//echo("NOT AVAILABLE");
	continue;
}
?>
<div class="col-sm-3">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				{{-- {{ dd($product->images[0]->image)}} --}}
				@if(count($product->images) == 0 )

				<img src="{{ asset("frontend/images/404/404.png")}}" alt="" />
				@else
				<img src="{{ asset('storage/'.$product->images[0]->image) }}" />
				@endif
				 
				
				<h2>${{ $product->price}} </h2>
				<p>{{ $product->name}} </p>
				<a href="{{ route('product_detail',$product->id)}}" class="btn btn-default add-to-cart">
				<i class="fa fa-eye"></i>View
				</a>
			</div>
			
		</div>
	</div>
</div> 
@endforeach
</div>