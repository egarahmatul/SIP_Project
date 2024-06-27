
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('') }}template/img/logo.png" type="image/x-icon">
    <title>Aplikasi Posyandu</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('')}}template/css/style.css">
    <link rel="stylesheet" href="{{asset('')}}template/css/components.css">
    
  <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/datatables/datatables.min.css'); }}">
    <link rel="stylesheet" href="{{ asset('template/datatables/dataTables.bootstrap4.min.css'); }}">
    <link rel="stylesheet" href="{{ asset('template/datatables/buttons.dataTables.min.css'); }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    
    <script src="{{asset('')}}jquery.min.js"></script>
    <link href="{{asset('')}}select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{asset('')}}select2/dist/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/Chartjs/Chart.min.css">
    <script type="text/javascript" src="{{ asset('template')}}/Chartjs/Chart.min.js"> </script>

    <!-- css untuk select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('template')}}/summernote/summernote-bs4.css">
    <!-- jika menggunakan bootstrap4 gunakan css ini  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <!-- cdn bootstrap4 -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #444;
          line-height: 41px;
      }
    </style>
    
    
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
          </ul>
          <div class="search-element">
           
          
            <div class="search-backdrop"></div>
            
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
 
              <a href="{{url('profile')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
      
              <div class="dropdown-divider"></div>

              <a onclick="return false" id="btn-delete" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i>  Log Out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      @include('template.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('contents')
      </div>
      @include('template.footer')
    </div>
  </div>
  
  @include('template.script')

</body>
</html>