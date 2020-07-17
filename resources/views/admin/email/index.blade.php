@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Email Templates Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Email Templates</li>
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
                    <div class="card-header">
                   {{--  <a href="{{ url('/admin/products/create') }}" class="btn btn-success btn-sm float-sm-right" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> --}}
                    <h3 class="card-title">Email Templates</h3></div>
                    <div class="card-body">
 
                        <div class="table-responsive">
                            <table class="table" id="email_template">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>slug</th>
                                        <th>subject</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        {{--     <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div> --}}
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
@push('datatable-js')
 <script type="text/javascript">
  $(function () {
    
        table = $('#email_template').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.email.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'slug', name: 'slug'},
            {data: 'subject', name: 'subject'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endpush

@endsection