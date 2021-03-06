<nav class="main-header navbar navbar-expand-md navbar-dark navbar-cyan">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{asset('storage/images/config/'.$data['config']->logo_image)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{$data['config']->site_title}}</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        
        <ul class="navbar-nav">
          @if (!empty($data['menu']['top-menu']))
            @foreach ($data['menu']['top-menu'] as $key => $value)
              @if (empty($value['children']))
                <li class="nav-item">
                  <a href="{{$value['href']}}" class="nav-link" target="{{$value['target']}}"> <i class="{{$value['icon']}}"></i> {{$value['text']}}</a>
                </li>
              @else
                <li class="nav-item dropdown">
                  <a id="dropdownSubMenu{{$key}}" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{$value['text']}}</a>
                  <ul aria-labelledby="dropdownSubMenu{{$key}}" class="dropdown-menu border-0 shadow">
                    @foreach ($value['children'] as $ckey => $cvalue)
                        @if (empty($cvalue['children']))
                          <li><a href="{{$cvalue['href']}}" class="dropdown-item"><i class="{{$cvalue['icon']}}"></i> {{$cvalue['text']}} </a></li>
                        @else
                          <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu{{$ckey}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{$cvalue['text']}}</a>
                            <ul aria-labelledby="dropdownSubMenu{{$ckey}}" class="dropdown-menu border-0 shadow">
                              @foreach ($cvalue['children'] as $gckey => $gcvalue)
                                @if (empty($gcvalue['children']))
                                  <li>
                                    <a tabindex="-1" href="{{$gcvalue['href']}}" class="dropdown-item">{{$gcvalue['text']}}</a>
                                  </li>
                                @else
                                  <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu{{$gckey}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{$gcvalue['text']}}</a>
                                    <ul aria-labelledby="dropdownSubMenu{{$gckey}}" class="dropdown-menu border-0 shadow">
                                      @foreach ($gcvalue['children'] as $ggckey => $ggcvalue )
                                        <li><a href="{{$ggcvalue['href']}}" class="dropdown-item">{{$ggcvalue['text']}}</a></li>
                                      @endforeach
                                    </ul>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </li>
                        @endif
                    @endforeach
                  </ul>
                </li>
              @endif
            @endforeach
          @endif
        </ul>
        <!-- SEARCH FORM -->
        {{-- <form class="form-inline ml-0 ml-md-3" action="/search">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" name="keyword" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->      
        <li class="nav-item">
          <form class="form-inline ml-0 ml-md-3" action="/search">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" name="keyword" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-shopping-cart"></i></a>
        </li>
      </ul>
    </div>
  </nav>