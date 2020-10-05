<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin" class="brand-link elevation-4">
    <img src="{{asset('small-icon.png')}}"
          alt="{{config('app.name')}} Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: .8">
    <span class="brand-text font-weight-light">{{config('app.name')}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('storage/images/user/'.Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @php
            $role = Auth::user()->role;
        @endphp
        @foreach ($AdminMenu as $item => $value)
          @if (in_array($role,$value['role']))
            @php
              $haschild = !empty($value['child']) ? true : false;
              $header = !empty($value['header']) ? true : false;
            @endphp
            @if ($header)
              <li class="nav-header">{{strtoupper($value['title'])}}</li>
            @else
              <li class="nav-item @if($haschild){{'has-treeview'}}@endif">
                <a href="{{$value['link']}}" class="nav-link">
                  <i class="nav-icon fas {{$value['icon']}}"></i>
                  <p>
                    {{$value['title']}}
                    @if ($haschild)
                      <i class="fas fa-angle-left right"></i>
                    @endif
                  </p>
                </a>
                @if ($haschild)
                  <ul class="nav nav-treeview">
                    @foreach ($value['child'] as $citem => $cvalue)
                      @if (in_array($role,$cvalue['role']))
                        <li class="nav-item">
                          <a href="{{$cvalue['link']}}" class="nav-link">
                            <i class="far {{$cvalue['icon']}} nav-icon"></i>
                            <p>{{$cvalue['title']}}</p>
                          </a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                @endif
              </li>      
            @endif
          @endif    
        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>