@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Coupon Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupons</li>
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
                    <a href="{{ url('/admin/coupons/create') }}" class="btn btn-success btn-sm float-sm-right" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    <h3 class="card-title">Coupons</h3></div>
                    <div class="card-body">
 
                        <div class="table-responsive">
                            <table class="table" id="coupon_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Expire On</th>
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
    
    table = $('#coupon_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.coupons.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'type', name: 'type'},
            {data: 'value', name: 'value'},
            {data: 'expire_on', name: 'expire_on'},          
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
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
        url: "coupons/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data) {
           swal("Poof! Coupon has been deleted!", {
            buttons: false,
            timer: 1000,
            
          });
        table.ajax.reload();
        }

    });
     
 
    
  } else {
    swal("Coupon is safe!", {
  buttons: false,
  timer: 1000,
});
  }
});
return false;
     
}        
</script>
@endpush

@endsection