@extends('frontend.layout.master')

@section('content')
 
  @section('content')
    <section id="cart_items">
      <div class="container">
       
        <div class="breadcrumbs">

          <ol class="breadcrumb">

            <li><a href="{{ route('homepage')}}">Home</a></li>
            <li class="active">View-Order</li>
            <button  class="btn-primary pull-right" onclick='printDiv();'>Print</button>  
          </ol>

        </div>
<div class="container" id="DivIdToPrint">
  <div class="card">
    <div class="card-header">
    Order Date :
    <strong>{{ $order->created_at }}</strong> 
      <span class="pull-right float-right"> <strong>Status:</strong><span id="status"> {{ ucfirst($order->status) }}</span></span>

    </div>
    <div class="card-body">
    <div class="row">
      <div class="col-sm-6">
      <h6 class="">From:</h6>
      <div>
      <strong>E-SHOPPER</strong>
      </div>
      <div>Madalinskiego 8</div>
      <div>71-101 Szczecin, Poland</div>
      <div>Email: info@webz.com.pl</div>
      <div>Phone: +48 444 666 3333</div>
      </div>
      <div class="col-sm-6">
      <h6 class="">To:</h6>
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
     

    <div class="pull-right  float-right col-sm-6">
    <table class="table table-clear">
    <tbody>
    <tr>
    <td class="">
    <strong>Subtotal</strong>
    </td>
    <td class="">${{ number_format($order->subtotal,2) }}</td>
    </tr>
    <tr>
    <td class="">
    <strong>Discount</strong>
    </td>
    <td class="right">${{number_format($order->discount,2)}}</td>
    </tr>
    <tr>
    <td class="">
     <strong>VAT </strong>
    </td>
    <td class="">${{ number_format($order->tax,2)}}</td>
    </tr>
    <tr>
    <td class="">
    <strong>Total</strong>
    </td>
    <td class="">
    <strong>${{number_format($order->grand_total,2)}}</strong>
    </td>
    </tr>
    </tbody>
    </table>

    </div>
    <div class="col-sm-6"></div>
    </div>

    </div>
</div>
</div>
      </div>
    </section> <!--/#cart_items-->
    
   
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
 
@endpush