	@extends('frontend.layout.master')
	@section('content')
		<section id="cart_items">
			<div class="container">
				<div class="breadcrumbs">
					<ol class="breadcrumb">
					  <li><a href="{{ route('homepage')}}">Home</a></li>
					  <li class="active">Orders</li>
					</ol>
				</div>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td>#</td>
								<td>Order Number</td>
								<td>Items</td>
								<td>GrandTotal</td>
								<td>Payment</td>
								<td>Order Status</td>
								<td>Order Date</td>
							</tr>
						</thead>
						<tbody>
							@forelse($orders as $order)
						 	<tr>
						 		<td>{{$loop->index+1}}</td>
						 		<td><a href="view-order/{{$order->id}}"> {{ $order->order_number }}</a></td>
						 		<td>{{ $order->item_count }}</td>
						 		<td>{{ $order->grand_total }}</td>
						 		<td><?=($order->payment_status == 0)?'<span class="text-danger">Pending</span>':'<span class="text-success">Paid</span>'?></td>
						 		<td>@if($order->status =='pending')
						 			<span class="text-warning">
						 			{{$order->status}}</span>
						 			@endif
						 			@if($order->status =='processing')
						 			<span class="text-primary">{{$order->status}}</span>
						 			@endif
						 			@if($order->status =='completed')
						 			<span class="text-success">{{$order->status}}</span>
						 			@endif
						 			@if($order->status =='decline')
						 			<span class="text-danger">{{$order->status}}</span>
						 			@endif

						 		</td>
						 		<td>{{ $order->created_at }}</td>
						 	</tr>
							@empty 
							 <tr><td colspan="4" class="text-center"><h4>No Orders</h4><td>
							 </tr>
							@endforelse

						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->
		 


	@endsection