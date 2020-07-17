@extends('layouts.master')
 
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Attribute Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">attribute</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row m-2">
          <div class="col-lg-3">
                
                <!-- Nav tabs -->
            <div>
            <ul class=" nav flex-column nav-tabs nav-pills bg-white">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">General</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#menu1">Attributes Values</a>
              </li>
            </ul>
          </div>
          </div>

        <!-- Tab panes -->
        <div class="tab-content col-lg-9 ">
          <div class="tab-pane container active" id="home">
            <div class="row">
           <div class="col-lg-12">
                <div class="card">
                <div class="card-header">Edit Attribute #{{ $productattribute->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product-attributes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($productattribute, [
                            'method' => 'PATCH',
                            'url' => ['/admin/product-attributes', $productattribute->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.product-attributes.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>   
                    
                </div>
            </div>
        </div>
          </div>
              {{-- {{ $productattribute->values }} --}}
          <div class="tab-pane container active" id="menu1">
          @include('admin.product-attribute-values.create',compact('productattribute'))</div>
          
        </div>
      </div>
    </div>
  </section>

  </div>
@endsection