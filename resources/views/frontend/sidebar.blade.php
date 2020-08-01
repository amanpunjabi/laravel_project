<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>

						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php $categories = getCategories() ?>
							@foreach($categories as $category)

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse"  data-target="#category_{{ $category->id }}" onclick="changeicon(this)">
										<span class=""><i class="fa fa-minus"></i></span>&nbsp;<a @if(isset($categoryname) && $category->category_name == $categoryname)style="color:#FC992B"@endif  href="{{ route('category.product',$category->id)}}" >{{ $category->category_name }}</a></a></h4>
										 
								</div>
								{{-- @while($childcategories = getChildCategories($category->id)) --}}
								<?php $subcategories = getChildCategories($category->id); ?>
								{{-- @if(count($childcategories) > 0) --}}

								@include('frontend.subCategoryList',['subcategories' => $subcategories])
								{{-- <div id="category_{{ $category->id }}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@forelse($childcategories as $childcategory)
											<li><a href="#{{$childcategory->id}}">{{$childcategory->category_name}} </a></li>
											@empty
											N/A
											@endforelse

										</ul>
									</div>
								</div> --}}
								{{-- @endwhile --}}
								{{-- @endif --}}
							</div>
							@endforeach
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a>
										<span class=""><a @if(isset($categoryname) &&  "In All Category" == $categoryname)style="color:#FC992B"@endif  href="{{ route('category.product')}}" >Explore all categories</a></a></h4>
										 
								</div>
						</div><!--/category-products-->
					 
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">

									@foreach(getBrands() as $brand)
									<li><a href="#"> <span class="pull-right">{{ App\Product::get()->where('brand_id',$brand->id)->count()}}</span>{{ $brand->name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						
						 
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{asset('Eshopper/images/home/shipping.jpg')}}"alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
@push('js')
<script type="text/javascript">
	function changeicon(e)
	{
		// console.log(e);
	   
	    
		var str = $(e).find("span").html();
		if(str == '<i class="fa fa-plus"></i>')
		{	
			
			$(e).find("span").html('<i class="fa fa-minus"></i>');
			$($(e).attr('data-target')).removeClass('collapse').addClass('in');

		}
		else
		{
			
			$(e).find("span").html('<i class="fa fa-plus"></i>');
			$($(e).attr('data-target')).removeClass('in').addClass('collapse');
		}
		//  return true;
	}
</script>

@endpush