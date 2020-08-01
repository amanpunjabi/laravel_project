@extends('layouts.master')

@section('content')
 <!-- Content Wrapper. Contains page content -->
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
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
           <div class="col-lg-12">
                <div class="card">
                 <div class="card-header">Order {{ $order->id }}</div>
                    <div class="card-body">
                     
                      <label   class="float-right" >  Update Status
                          <select class="form-control"  onchange="updateOrder(this)" > 
                            <option value="pending" {{ ($order->status=="pending")?"selected":''}}>pending</option>
                            <option value="processing" {{ ($order->status=="processing")?"selected":''}}>processing</option>
                            <option value="completed" {{ ($order->status=="completed")?"selected":''}}>completed</option>
                            <option value="decline" {{ ($order->status=="decline")?"selected":''}}>decline</option> 
                          </select>
                      </label>
                        <a href="{{ url('/admin/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        {{-- <a href="{{ url('/admin/orders  /' . $order->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}

                       {{--  {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/products', $order->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Product',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} --}}
                        <a href="#" type='button' class="btn btn-info btn-sm" id='btn' value='Print' onclick='printDiv();'>Print</a>
                    </div>   
                
                <div class="container" id="DivIdToPrint">
  <div class="card">
<div class="card-header">
Order Date :
<strong>{{ $order->created_at }}</strong> 
  <span class="float-right"> <strong>Status:</strong><span id="status"> {{ ucfirst($order->status) }}</span></span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>
<strong>E-SHOPPER</strong>
</div>
<div>Madalinskiego 8</div>
<div>71-101 Szczecin, Poland</div>
<div>Email: info@webz.com.pl</div>
<div>Phone: +48 444 666 3333</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>{{ ucfirst($order->firstname) }} {{ ucfirst($order->lastname) }}</strong>
</div>
<div>{{ $order->address }}</div>
<div>{{ $order->city }}</div>
<div>{{ $order->state }}</div>

 <div>Phone: {{ $order->phone }}</div>
</div>
  

</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Item</th>
<th>Description</th>

<th class="right">Unit Cost</th>
  <th class="center">Qty</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
  <?php $product = App\Product::find($item->product_id); ?>

  <?php  $variation = App\ProductVariation::find($item->variation_id); ?>
  <tr>
    <td class="center">{{ $loop->index+1 }}</td>
    <td class="left strong">{{$product->name}}({{$variation->attribute_value}})</td>
    <td class="left">{{ $product->description }} </td>

    <td class="right">{{ number_format($item->price,2) }}</td>
      <td class="center">{{ $item->quantity }}</td>
    <td class="right">{{ number_format($item->price*$item->quantity,2)}}</td>
  </tr>
@endforeach
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right">${{ number_format($order->subtotal,2) }}</td>
</tr>
<tr>
<td class="left">
<strong>Discount</strong>
</td>
<td class="right">${{number_format($order->discount,2)}}</td>
</tr>
<tr>
<td class="left">
 <strong>VAT </strong>
</td>
<td class="right">${{ number_format($order->tax,2)}}</td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>${{number_format($order->grand_total,2)}}</strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
</div>
</div>

                    </div>  
                </div>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('js')
<script type="text/javascript">
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

 
  newWin.document.write('<html><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> <body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
<script type="text/javascript">
  function updateOrder(e)
  {
 
     
    $.ajax({
        url: "{{route('admin.orders.update',$order->id)}}" ,
        type: 'patch',
        data: {
            "status": e.value,
            "_token":  "{{ csrf_token() }}",
        },
        success: function (data) {
          if(data == "false")
          {
            swal("oops! Failed to update order", {
            buttons: false,
            timer: 1000,
            
          });
          }
          else
          { 

            swal("Poof! Order status has been changes!", {
            buttons: false,
            timer: 1000,
            
          });
          str = e.value;
          str = str.charAt(0).toUpperCase() + str.slice(1); 
            $('#status').html(str);
          }
           
           
        }

    });
  }
</script>
@endpush