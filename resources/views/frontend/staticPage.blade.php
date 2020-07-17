@extends('frontend.layout.master')
@section('content')
<div   class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">{{ $page->title }}</strong></h2>    			    				    				
					
					</div>
				</div>			 		
			</div>    	
    		<div class="row"> 
    		<div class="col-sm-12"> 
    		<div class="well">	
    		 <?php echo $page->description; ?> 
    		</div>
    		</div>
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
    @push('js')
 
 
@endpush
@endsection