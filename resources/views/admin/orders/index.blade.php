@extends('layouts.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Order Management</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-success btn-sm float-sm-right" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    <h3 class="card-title">Orders</h3></div>
                    <div class="card-body">
 
                        <div class="table-responsive" style="display: block;width:  width: 80%;">
                            <table class="table" id="product_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>Email</th>
                                        <th>Items</th>
                                        <th >Grand Total</th>
                                         <th>Payment</th>
                                        <th>Order Status</th>
                                        <th>Order Date</th>
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
    
        table = $('#product_list').DataTable({
        processing: true,
        serverSide: true,

         columnDefs: [
            { width: 200, targets: 0},
            { width: 200, targets: 1},
            { width: 200, targets: 2},
            { width: 200, targets: 3},
            { width: 200, targets: 4},
            { width: 200, targets: 5},
            { width: 200, targets: 6},
            { width: 200, targets: 7},
            { width: 200, targets: 8}             
        ],
        ajax: "{{ route('admin.orders.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'order_number', name: 'order_number'},
            {data: 'user_id', name: 'user_id'},
            {data: 'item_count', name: 'item_count'},
            {data: 'grand_total', name: 'grand_total'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
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
        url: "products/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data) {
           swal("Poof! Product Data has been deleted!", {
            buttons: false,
            timer: 1000,
            
          });
           // table.ajax.reload();
           table.ajax.reload();

        }

    });
     
 
    
  } else {
    swal("Product Data is safe!", {
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