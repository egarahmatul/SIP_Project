<header class="header-area">

    <!-- Main Header Start -->
    <div class="main-header-area">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <!-- Classy Menu -->
          <nav class="classy-navbar justify-content-between" id="dentoNav">

            <!-- Logo -->
            <a class="nav-brand" href="{{url('')}}"><img src="{{asset('assets/logo.png')}}" width="17%" alt="">ePosyandu</a>

            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <!-- Menu -->
            <div class="classy-menu">

              <!-- Close Button -->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>

              <!-- Nav Start -->
              <div class="classynav">
                <ul id="nav">
                  <li><a href="{{url('')}}">Home</a></li>
                  <li><a href="{{url('jadwal')}}">Jadwal</a></li>
                  <li><a href="{{url('perkembangan')}}">Riwayat Perkembangan</a></li>
                </ul>
              </div>
              <!-- Nav End -->
            </div>

            <?php if( isset(Auth::user()->id) == ''){?>
              <a href="{{url('login')}}" class="btn dento-btn booking-btn">Login</a>
              
            <?php }else{ ?>
              <div class="classynav">
                <ul id="nav">
                  <li><a href="#">{{Auth::user()->name}}</a>
                    <ul class="dropdown">
                      {{-- <li><a href="{{url('logout')}}">Logout</a></li> --}}
                        <li> <a onclick="return false" id="btn-delete" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i>  Log Out</a></li>
                      
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                  </li>
                </ul>
                 
              </div>
            <?php }?>

           
          </nav>
        </div>
      </div>
    </div>
  </header>