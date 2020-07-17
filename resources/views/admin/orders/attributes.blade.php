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
                  <div class="card-header">Product Attributes</div>
                  <div class="card-body">
                  <div class="form-group">
                  @forelse($attributes as $attribute)
                  <span class="checkbox">
                  <label>{!! Form::checkbox('attr[]',$attribute->id,null,["class"=>'attr']) !!} {{ $attribute->name }}</label>
                  </span>
                  @empty
                  <h3>Attributes not available</h3>
                  @endforelse
                  </div>
                  <div class="form-group">{{ Form::button('Add/Remove',['class'=>'btn btn-primary','onclick'=>'return getattrval()']) }}
                  </div>
                  {{ Form::open(['route'=>['admin.products.assign_values', $product->id],'method'=>'post','class'=>''])}}
                  <div class="form-group" id="select_value">
                  </div>
                  {!! $errors->first('value_id', '<p class="text-danger">:message</p>') !!}
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
    var attr = [];
    $(".attr:checked").each(function() {
      attr.push($(this).val());
    });
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
</script>
@endpush 