@extends('layouts.master')
 
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
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
                   <div class="card-header">Contact Reply #{{ $contact->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/contact') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
 
                        {{-- @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif --}}
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $contact->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $contact->name }} </td></tr><tr><th> Email </th><td> {{ $contact->email }} </td></tr><tr><th>Subject </th><td> {{ $contact->subject }} </td></tr>
                                    <tr><th>Message </th><td> {{ $contact->message }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                        {!! Form::model($contact, [
                            'method' => 'PATCH',
                            'url' => ['/admin/contact', $contact->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        <div class="form-group {{ $errors->has('note_admin') ? 'has-error' : ''}}">
                            {!! Form::label('note_admin', 'Note', ['class' => 'control-label']) !!}
                            {!! Form::textarea('note_admin', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                            {!! $errors->first('note_admin', '<p class="help-block">:message</p>') !!}

                            {{-- Form::hidden('product_id',$product->id) }} --}}
                          </div>
                           
                          <div class="form-group">
                              {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
                          </div>
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

