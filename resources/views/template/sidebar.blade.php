<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand d-flex align-items-center">
        <img src="{{asset('assets/logoDashboard.png')}}" width="80%" alt="">
        
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="">SIP</a>
      </div>
      <div class="text-center">
        {{-- <img src="{{asset('')}}nobg_collapse_logo.png" alt="logo" width="55" class="shadow-light"> --}}
      </div>
      <ul class="sidebar-menu">
        <?php if(Auth::user()->hak_akses == 'bidan'){ ?>
          <li class="menu-header">Dashboard</li>
          <li><a class="nav-link" href="{{url('dashboard-admin')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
          <li><a class="nav-link" href="{{url('data-balita-bidan')}}"><i class="fas fa-user"></i> <span>Data Balita </span></a></li>
          <li><a class="nav-link" href="{{url('data-jadwal')}}"><i class="fas fa-file"></i> <span>Data Jadwal </span></a></li>
          <li class="menu-header">Data Pemeriksaan</li>
          <li><a class="nav-link" href="{{url('data-pemeriksaan-bidan')}}"><i class="fas fa-notes-medical"></i> <span>Data Pemeriksaan </span></a></li>
          <li><a class="nav-link" href="{{url('laporan-pemeriksaan')}}"><i class="fas fa-laptop-medical"></i> <span>Laporan Pemeriksaan </span></a></li>

          <?php }else if(Auth::user()->hak_akses == 'petugas'){ ?>
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{url('dashboard-admin')}}"><i class="fas fa-home"></i> <span>Dashboard </span></a></li>
            
            <li><a class="nav-link" href="{{url('data-balita-petugas')}}"><i class="fas fa-user"></i> <span>Data Balita</span></a></li>
            <li><a class="nav-link" href="{{url('laporan-pemeriksaan-petugas')}}"><i class="fas fa-file"></i> <span>Laporan Posyandu</span></a></li>
            <li><a class="nav-link" href="{{url('data-pemeriksaan-petugas')}}"><i class="fas fa-notes-medical"></i> <span>Data Pemeriksaan</span></a></li>
           
          <?php }else{ ?>
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{url('dashboard-admin')}}" style="font-size:16px;color:black;"><i class="fas fa-home" ></i><span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown" style="font-size:16px;"><i class="fas fa-users"></i><span>Data Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('data-admin')}}" style="font-size:16px;">Data Admin</a></li>
                <li><a class="nav-link" href="{{url('data-bidan')}}" style="font-size:16px;">Data Bidan</a></li>
                <li><a class="nav-link" href="{{url('data-petugas')}}" style="font-size:16px;">Data Petugas</a></li>
                <li><a class="nav-link" href="{{url('data-orangtua')}}" style="font-size:16px;">Data Orang Tua</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="{{url('data-balita')}}" style="font-size:16px;"><i class="fas fa-user"></i> <span>Data Balita </span></a></li>
            <li><a class="nav-link" href="{{url('data-jadwal')}}" style="font-size:16px;"><i class="fas fa-file"></i> <span>Data Jadwal </span></a></li>
            <li class="menu-header">Data Pemeriksaan</li>
            <li><a class="nav-link" href="{{url('data-pemeriksaan')}}" style="font-size:16px;"><i class="fas fa-notes-medical"></i> <span>Data Pemeriksaan </span></a></li>
            <li class="menu-header">Data Laporan</li>
            <li><a class="nav-link" href="{{url('laporan-pemeriksaan')}}" style="font-size:16px;"><i class="fas fa-laptop-medical"></i> <span>Laporan Pemeriksaan </span></a></li>
           
            
          <?php }   ?>
      </aside>
    </div>