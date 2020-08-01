@extends('layouts.master')
@section('content')
	<div class="content-wrapper">
	 	<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Order Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      	<div class="row">
           <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    	<h3 class="card-title">Orders of user #<a href="{{ route('admin.users.show',$user->id)}}">{{$user->email}}</a></h3>
                    </div>
                    
                    <div class="card-body">
 
                        <div class="table-responsive">
                           <table class="table table-condensed" id="orderList">
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
						 		<td><a href="{{route('admin.orders.show',$order->id)}}"> {{ $order->order_number }}</a></td>
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
                   </div>
                </div>
             
      </div>
    </section>

	 </div>
	 
		 
@endsection
@push('datatable-js')
<script type="text/javascript">
table = $('#orderList').DataTable({
	dom: 'Bfrtip',  
        buttons: [
        'pageLength', 
         	{
                extend: 'copyHtml5',
                 
            },
            {
                extend: 'excelHtml5',
                
            },
            {
                extend: 'pdfHtml5',
                 
            },

            
        ],
});
</script>
@endpush