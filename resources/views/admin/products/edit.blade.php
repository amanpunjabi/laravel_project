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


         
 
          <div class="col-2">
          <ul class="nav nav-tabs flex-column card nav-pills">
          <li class="nav-item">
            <a class="nav-link active"   href="{{ route('admin.products.edit',$product->id) }}">General</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('admin.products.images',compact('product')) }}">Images</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('admin.products.attribute_list',$product->id) }}">Attributes</a>
          </li>
          </ul>
          </div>
     
           <div class="col-lg-10">
                <div class="card"> 
                  <div class="card-header">Edit Product #{{ $product->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($product, [
                            'method' => 'PATCH',
                            'url' => ['/admin/products', $product->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.products.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

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

