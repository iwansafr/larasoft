<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.part.meta')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  @include('home.part.navbar')
  <div class="content-wrapper" style="background: white;">
    @include('home.part.slider')
    {{-- @include('home.part.header') --}}
    <div class="content">
      <div class="container">
        <div class="row">
          @include('home.part.content')
        </div>
      </div>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Cart</h5>
      <p>Product</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('home.part.footer')
  {{-- <footer class="main-footer"> --}}
    <!-- To the right -->
    {{-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. --}}
  {{-- </footer> --}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/AdminLte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLte/dist/js/adminlte.min.js"></script>
</body>
</html>
