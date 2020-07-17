        <div class="row">
           <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ url('/admin/category/create') }}" class="btn btn-success btn-sm float-sm-right" title="Add New User">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    <h3 class="card-title">Attribute values</h3></div>
                    <div class="card-body">
 
                        <div class="table-responsive">
                            <table class="table" id="value_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
   
@push('datatable-js')
 <script type="text/javascript">
  $(function () {
    
    table = $('#value_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.product-attribute-values.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'value', name: 'value'},
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
        url: "product-attribute-values/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data) {
           swal("Poof! value has been deleted!", {
            buttons: false,
            timer: 1000,
            
          });
        table.ajax.reload();
        }

    });
     
 
    
  } else {
    swal("Value is safe!", {
  buttons: false,
  timer: 1000,
});
  }
});
return false;
     
}        
</script>
@endpush