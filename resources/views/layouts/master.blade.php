<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{ asset("plugins/fontawesome-free/css/all.min.css") }}>
  <!-- Ionicons -->
  <link rel="stylesheet" href={{ asset("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css") }}>
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href={{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}>
  <!-- iCheck -->
  <link rel="stylesheet" href={{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}>
  <!-- JQVMap -->
  <link rel="stylesheet" href={{ asset("plugins/jqvmap/jqvmap.min.css") }}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset("dist/css/adminlte.min.css") }}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}>
  <!-- Daterange picker -->
  <link rel="stylesheet" href={{ asset("plugins/daterangepicker/daterangepicker.css") }}>
  <!-- summernote -->
  <link rel="stylesheet" href={{ asset("plugins/summernote/summernote-bs4.css") }}>
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700") }}"  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('select2-4.0.13/dist/css/select2.min.css') }}">
  {{-- <script src={{ asset("sweetalert/sweetalert.min.js") }}></script> --}}

  @stack('css')
  

</head>
<body class="hold-transition sidebar-mini layout-fixed">
   @if (Session::has('success'))
    <?php Alert::success('',session('success')); ?>
   @endif
   @if (Session::has('failed'))
    <?php Alert::error('',session('failed')); ?>
   @endif
<div class="wrapper">
 
 <!-- Header -->
    @include('layouts.header')


 <!-- Sidebar -->
    @include('layouts.sidebar')


    @yield('content')

 <!-- Sidebar -->
    @include('layouts.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{ asset("plugins/jquery/jquery.min.js") }}></script>
<!-- jQuery UI 1.11.4 -->
<script src={{ asset("plugins/jquery-ui/jquery-ui.min.js") }}></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src={{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- ChartJS -->
<script src={{ asset("plugins/chart.js/Chart.min.js") }}></script>
<!-- Sparkline -->
<script src={{ asset("plugins/sparklines/sparkline.js") }}></script>
<!-- JQVMap -->
<script src={{ asset("plugins/jqvmap/jquery.vmap.min.js") }}></script>
<script src={{ asset("plugins/jqvmap/maps/jquery.vmap.usa.js") }}></script>
<!-- jQuery Knob Chart -->
<script src={{ asset("plugins/jquery-knob/jquery.knob.min.js") }}></script>
<!-- daterangepicker -->
<script src={{ asset("plugins/moment/moment.min.js") }}></script>
<script src={{ asset("plugins/daterangepicker/daterangepicker.js") }}></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src={{ asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}></script>
<!-- Summernote -->
<script src={{ asset("plugins/summernote/summernote-bs4.min.js") }}></script>
<!-- overlayScrollbars -->
<script src={{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("dist/js/adminlte.js") }}></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src={{ asset("dist/js/pages/dashboard.js") }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset("dist/js/demo.js") }}></script>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
@stack('datatable-js');
<script type="text/javascript" src="{{ asset('select2-4.0.13/dist/js/select2.min.js') }}"></script>
@include('sweetalert::alert')
@stack('js');
</body>
</html>
