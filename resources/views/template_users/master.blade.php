
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Dento - Dentist &amp; Medical HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title -->
  <title>Sistem Informasi Posyandu</title>

  <!-- Favicon -->
  <link rel="icon" href="./img/core-img/favicon.ico">

  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="{{asset('')}}assets/style.css">
  <link rel="stylesheet" href="{{ asset('template/datatables/datatables.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('template/datatables/dataTables.bootstrap4.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('template/datatables/buttons.dataTables.min.css'); }}">
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="preload-content">
      <div id="dento-load"></div>
    </div>
  </div>

  @include('template_users.navbar');


  @yield('contents');

  
  @include('template_users.script')
  @include('template_users.footer')
  
  