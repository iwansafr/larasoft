<!DOCTYPE html>
<html>
<head>
  @include('part.meta')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
  @include('part.navbar')
  @include('part.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="{{config('app.url')}}">{{config('app.name')}}</a>.</strong> All rights
    reserved.
  </footer>

  {{-- <aside class="control-sidebar control-sidebar-dark">

  </aside> --}}

</div>

<!-- jQuery -->
<script src="/AdminLte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/AdminLte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/AdminLte/dist/js/demo.js"></script>
@stack('scripts')
<script>
  function li_active(){
		var current = $('a[href="'+location.pathname+'"]');
    current.addClass('active');
		if(current.closest('.has-treeview').length>0){
      console.log(current.closest('.has-treeview'));
      var li = current.closest('.has-treeview').addClass('menu-open');
      li.children().addClass('active');
		}
	}
  li_active();
</script>
@livewireScripts
</body>
</html>
