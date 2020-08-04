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
				<div class="table-responsive ">
					<table class="table  cart_info" id="order_list">
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
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js
"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js
"></script>
 <script type="text/javascript">
   $(document).ready(function(){
   	$('#order_list').DataTable();
    });   
</script>
@endpush