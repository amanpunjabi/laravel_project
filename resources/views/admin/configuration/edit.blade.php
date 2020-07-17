@extends('layouts.master')
 
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Configuration Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Configuration</li>
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
                     <div class="card-header">Manage Configuration</div>
                    <div class="card-body">

                      {{  Form::open(['url' => route('admin.configuration.update'),'method' => 'post', 'files' => true,'class'=>'form-horizontal']) }}

                      @foreach($data as $value)
                      <div class="form-group row">
                      

                     {{  Form::label($value['key_name'],$value['title'],['class'=>'control-label col-sm-2']) }}
                      
                      {{ Form::text($value['key_name'],$value['value'] ?? '', ['class' => 'form-control col-sm-8', 'placeholder' => 'firstname']) }}
                      
                      </div>
                    @endforeach

                  <button type="submit" class="btn btn-primary">Update</button>

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

