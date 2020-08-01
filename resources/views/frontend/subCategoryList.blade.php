<div id="category_{{ $category->id }}" class="panel-collapse  in">
<div class="panel-body">
{{-- <ul> --}}
@forelse($subcategories as $subcategory)
<?php $subcat = getChildCategories($subcategory->id); ?>
	<div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#category_{{ $category->id }}" data-target="#category_{{ $subcategory->id }}" onclick="changeicon(this)">
	@if(count($subcat))
	<span class=""><i class="fa fa-minus"></i></span>
	@endif<a  @if(isset($categoryname) && $subcategory->category_name == $categoryname)style="color:#FC992B"@endif href="{{ route('category.product',$subcategory->id)}}" >{{ $subcategory->category_name }}</a></a></h4></div>
	
  @if(count($subcat))
    @include('frontend.subCategoryList',['subcategories' => $subcat,'category'=>$subcategory])
  @endif
  
  
@empty
 <div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" >N/A</a></h4></div>
@endforelse
{{-- </ul> --}}
</div>
</div>

