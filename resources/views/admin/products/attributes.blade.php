@extends('layouts.master')
 
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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

          <div class="col-lg-2">
          <ul class="nav nav-tabs flex-column card nav-pills">
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('admin.products.edit',$product->id) }}">General</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('admin.products.images',$product->id) }}">Images</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active"   href="{{ route('admin.products.attribute_list',$product->id) }}">Attributes</a>  
          </li>
          </ul>
          </div>
          <div class="col-lg-10">
           <div>
                <div class="card"> 
                  <div class="card-header">Create Product Variation</div>
                  <div class="card-body">
                  {{ Form::open(['route'=>['admin.products.assign_values', $product->id],'method'=>'post','class'=>''])}}
                  <div class="form-group">
                  @forelse($attributes as $attribute)
                  <span class="checkbox">
                  <label>{!! Form::radio('attribute_id',$attribute->id,null,["class"=>'attr']) !!} {{ $attribute->name }}</label>
                  </span>
                  @empty
                  <h3>Attributes not available</h3>
                  @endforelse
                   <label>{!! Form::radio('attribute_id',"",null,["class"=>'attr']) !!} NA</label>
                  {!! $errors->first('attribute_id', '<p class="text-danger">:message</p>') !!}
                  </div>
                  <div class="form-group">{{ Form::button('Add/Remove',['class'=>'btn btn-primary','onclick'=>'return getattrval()']) }}
                  </div>
                  
                  <div class="form-group" id="select_value">
                  </div>
                  {!! $errors->first('attribute_value', '<p class="text-danger">:message</p>') !!}
                  <div class="form-group">
                    {{ Form::hidden('product_id',$product->id) }}
                  {{ Form::label('quantity', 'Quantity: ', ['class' => 'control-label']) }}
                  {{ Form::text('quantity',null,['class'=>'form-control col-lg-5']) }}
                  {!! $errors->first('quantity', '<p class="text-danger">:message</p>') !!}
                  </div>
                  <div class="form-group">
                  {{ Form::label('price', 'Price: ', ['class' => 'control-label']) }}
                  {{ Form::text('price',null,['class'=>'form-control col-lg-5']) }}
                  {!! $errors->first('price', '<p class="text-danger">:message</p>') !!}
                  </div>
                  <div class="form-group">{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
                  </div>
                  {{ Form::close() }}
                </div>
            </div>
          </div>
          <div>
                <div class="card"> 
                  <div class="card-header">Product Variation List</div>
                  <div class="card-body">
                  <table class="table" id="attributes-table">
                  <thead>
                    <tr>
                    <th>id</th>
                    <th>attribute</th>
                    <th>value</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($product->variation as $variation) <tr>
                     
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ get_attribute_name($variation->attribute_id) }}</td>
                      {{-- <td>{{ get_attribute_value($variation->attribute_value) }}</td> --}}
                     <td> {{$variation->attribute_value}}</td>
                      <td>{{ $variation->quantity }}</td>
                      <td>{{ $variation->price }}</td>
                      <td><form action="{{ route('admin.remove-variant',$variation->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                            <button type="submit"  class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                  </tr> 
                  @endforeach
                  </tbody>
                  </table>
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
  function getattrval()
  {
    var attr;
    $(".attr:checked").each(function() {
      // attr.push($(this).val());
      attr = $(this).val();
    });
    
    if(attr == null)  {
      $('#select_value').html();
    }
    else{
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
    url: "{{ route('admin.products.attribute_value') }}",
    type: 'GET',
    data: {
        "attr": attr,
        "_token": token,
    },
    success: function (data) {
       $('#select_value').html(data);
    }

    });
  }

 
  }
</script>
@endpush 
@push('datatable-js')
<script type="text/javascript">

$(document).ready(function(){
  $('#attributes-table').DataTable( {
    responsive: true
} )
});
</script>
@endpush