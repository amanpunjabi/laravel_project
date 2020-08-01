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
      <h3 class="pancardel-title"><i class="fa fa-bar-chart"></i> Coupon-Used Report</h3>

      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered"  id="reports" style="width:100%">
      <thead>
      <tr>
      <td>#</td>
      <td class="text-left">Coupon</td>
      <td class="text-left">Orders No.</td>
      <td class="text-right">Phone</td>
      <td class="text-right">Discount</td>
      <td class="text-right">Used On</td> 
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
        processing: true,
        serverSide: true,
        // lengthChange: false,
        ajax: {
          url :"{{ route('admin.report.coupon') }}",
         data: function (d) {
              d.start_date = $('[name=start_date]').val(); 
              // alert(d.date_start);
              d.end_date = $('[name=end_date]').val()
             // alert(d.filter_group);
          }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'coupon', name: 'coupon'},
            {data: 'order_number', name: 'order_number'}, 
            {data: 'phone', name: 'phone'},
            {data: 'discount', name: 'discount'},
            {data: 'created_at', name: 'created_at'},  
        ]
    });
    
  });
  $('#search-form').on('submit', function(e) {
      e.preventDefault();
        table.draw();
        
    });
</script>
@endpush