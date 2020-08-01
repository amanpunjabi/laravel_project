<div class="row">
      {{-- col-1 starts --}}

      <div class="col-md-9 col-md-pull-3 col-sm-12">
      <div class="card card-default">
      <div class="card-header">
        {{-- <div class="btn-group btn-group-toggle float-sm-right" data-toggle="buttons">
                  <label class="btn  bg-light active">
                    <input type="radio" name="options" id="option1" autocomplete="off"  > Todays
                  </label>
                  <label class="btn bg-light">
                    <input type="radio" name="options" id="option2" autocomplete="off"> This Month
                  </label>
                  <label class="btn bg-light">
                    <input type="radio" name="options" id="option3" autocomplete="off"> This Year
                  </label>
          </div> --}}
      <h3 class="pancardel-title"><i class="fa fa-bar-chart"></i> Sales Report</h3>

      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered"  id="reports" style="width:100%">
      <thead>
      <tr>
      <td>#</td>
      <td class="text-left">Date Start</td>
      <td class="text-left">Date End</td>
      <td class="text-right">No. Orders</td>
      <td class="text-right">No. Products</td>
      <td class="text-right">Tax</td>
      <td class="text-right">Total</td>
      </tr>
      </thead>
    </table>
      </div>
     </div>
    </div>
  </div>

      {{-- col-2 ends --}}

      {{-- col-2 start --}}
      <div id="filter-report" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
      <div class="card card-default">
      <div class="card-header">
      <h3 class="card-title"><i class="fa fa-filter"></i> Filter</h3>
      </div>
      <div class="card-body">
      <form id="search-form" action="#" >
      <div class="form-group">
      <label class="control-label" for="input-date-start">Date Start</label>
      <div class="input-group">
      <input type="text" name="start_date" value="{{date("Y-m-d", strtotime("-1 month"))}}" placeholder="Date Start" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control date">
     
      </div>
      </div>
      <div class="form-group">
      <label class="control-label" for="input-date-end">Date End</label>
      <div class="input-group">
      <input type="text" name="end_date" value="{{date('Y/m/d')}}" placeholder="Date End" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control date">
      
      </div>
      </div>
      <div class="form-group">
      <label class="control-label" for="input-group">Group By</label>
      <select name="filter_group" id="input-group" class="form-control">
      <option value="year">Years</option>
      <option value="month">Months</option>
      <option value="week" selected="selected">Weeks</option>
      <option value="day">Days</option>
      </select>
      </div>
      <div class="form-group">
      <label class="control-label" for="input-status">Status</label>
      <select name="filter_order_status_id" id="input-status" class="form-control">
      <option value="">All Statuses</option>
      <option value="pending">Pending</option>
       <option value="processing">Processing</option> 
      <option value="completed">Completed</option> 
      <option value="decline">Declined</option>  
      </select>
      </div>
      <div class="form-group text-right">
      <button type="submit" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i> Filter</button>
      </div>
      </form>
      </div>
      </div>
      </div>
      {{-- col-2 ends --}}

</div>
@push('datatable-js')
 <script type="text/javascript">
  $(function () {
    
        table = $('#reports').DataTable({
         // searching: false,
        processing: true,
        serverSide: true,
        dom: 'Bfrtip',  
        buttons: [
        'pageLength', 
         {
                extend: 'copyHtml5',
                 
            },
            {
                extend: 'excelHtml5',
                
            },
            {
                extend: 'pdfHtml5',
                 
            },

            
        ],
        // lengthChange: false,
        ajax: {
          url :"{{ route('admin.report.sales') }}",
         data: function (d) {
              d.start_date = $('[name=start_date]').val(); 
              // alert(d.date_start);
              d.end_date = $('[name=end_date]').val();
              d.filter_group = $('[name=filter_group]').val();
              d.status = $('[name=filter_order_status_id]').val();
              d.reportType = "sales";
              // alert(d.filter_group);
          }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'number_of_orders', name: 'number_of_orders'},
            {data: 'num_of_products', name: 'num_of_products'},
            {data: 'grand_total', name: 'grand_total'},
            {data: 'tax', name: 'tax'}, 
        ]
    });
    
  });
  $('#search-form').on('submit', function(e) {
      e.preventDefault();
        table.draw();
        
    });
</script>
@endpush