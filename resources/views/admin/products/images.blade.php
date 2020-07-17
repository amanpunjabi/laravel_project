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
            <a class="nav-link active"   href="{{ route('admin.products.images',$product->id) }}">Images</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('admin.products.attribute_list',$product->id) }}">Attributes</a>
          </li>
          </ul>
          </div>
          <div class="col-lg-10">
           <div>
                <div class="card"> 
                  <div class="card-header">Product Images</div>
                  <div class="card-body">
                   {!! Form::model($product, [
                            'method' => 'PATCH',
                            'route' => ['admin.products.images.save', $product->id],
                            'class' => 'form-horizontal ',
                            'files' => true
                        ]) !!}                        
                  <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                      {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
                      {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                       
                      {!! $errors->first('image', '<p class="help-block text-danger">:message</p>') !!}
                  </div>


                <div class="form-group">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
                  </div>
                </div>
            </div> <div>
                <div class="card"> 
                  <div class="card-header">Image List</div>
                  <div class="card-body">
                     <div class="row"> 
                         @forelse($product->images as $pro)
                          
                          <div class="card">  
                            <div class="card-header">
                              <a href="#"  id="{{ $pro->id }}" onclick="return show_warning(this)" class=" float-right" style="color: #CD5C5C"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            </div>
                          <div class="card-body">
                            <div class="col-md-3">
                             
                            <img src="{{ asset('storage/'.$pro->image) }}"  height="200px" width="200px" style="cursor:pointer" /> 
                          </div>
                          </div>
                          </div>
                          @empty
                        <h3>No Images</h3> 
                        @endforelse
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
@push('datatable-js')
<script type="text/javascript">
 function show_warning(ev){
  var id = $(ev). attr("id");
  // alert(id);
  
 swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/admin/products/"+id+"/images",
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data) {
           swal("Poof! Image Data has been deleted!", {
            buttons: false,
            timer: 1000,
            
          });
           // table.ajax.reload();
           location.reload();
        }

    });
     
 
    
  } else {
    swal("Image is safe!", {
  buttons: false,
  timer: 1000,
});
  }
});
return false;
     
}        
</script>
@endpush
