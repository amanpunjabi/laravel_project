<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<?php $banners = getBanners(); ?>
						<ol class="carousel-indicators">
							@foreach($banners as $banner)
							 <li data-target="#slider-carousel" data-slide-to="{{ $loop->index }}" class="{{($loop->first)?'active':''}}"></li>
							@endforeach
						</ol>
						
						
						 
						<div class="carousel-inner">
							<?php $i=0; /*echo "<pre>"; */?>
						 {{-- {{ getBanners() 	}} --}}
						 @foreach($banners as $banner)
						 {{-- {{ $banner }} --}}
							<div class="item {{ ($i==0)?'active':'' }}">
								<div class="col-sm-6">

									<h1><span>E</span>-SHOPPER</h1>
									<h2>{{ $banner->title }}</h2>
									<p>{{ $banner->content }}</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src='{{ asset("storage/".$banner->image)}}' class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
							<?php $i++; ?>
						
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->