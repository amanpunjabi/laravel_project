@extends('layouts.master')
@push('css')
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
@endpush
@push('css')
 <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
 <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
@endpush


@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Report</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
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
                      <h3 class="card-title"><i class="fa fa-bar-chart"></i> Choose the report type</h3>
                     </div>
                    <div class="card-body">
                      <div class="well">
<div class="input-group">
<select name="report" onchange="location = this.value;" class="form-control">
<option value="{{asset('admin/report')}}" @if($type == 'sales')
       {{'selected'}}
        @endif>Sales Report</option>
<option value="{{asset('admin/report/user')}}" @if($type == 'user')
       {{'selected'}}
        @endif>User Registered</option>
<option value="{{asset('admin/report/coupon')}}" @if($type == 'coupon')
       {{'selected'}}
        @endif>Coupon Used</option>
</select>
<div class="input-group-append">
    <span class="input-group-text" id="basic-addon2"><i class="fa fa-filter"></i> Filter</span>
  </div></div>
</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        {{-- row start --}}
       
        @if($type == 'sales') 
        @include('admin.reports.sale-report')
        @endif

        @if($type == 'user')
        @include('admin.reports.user-report')
        @endif

        @if($type == 'coupon')
        @include('admin.reports.coupon-used')
        @endif
        

    {{-- row end    --}}
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection	
@push('js')
<script>
   $(function() {
      $( ".date" ).datepicker({
        dateFormat:"yy-mm-dd",
      });
      
   });
</script>
<script type="text/javascript">
  function loadReport(e){
    alert(e.value);
  }
</script>
@endpush