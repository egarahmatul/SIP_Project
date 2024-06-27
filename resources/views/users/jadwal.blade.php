@extends('template_users.master')
@section('contents') 
 <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-gradient-overlay" style="background-image: url({{url('assets/posyandu3.jpg')}});">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title">Jadwal</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcumb--con">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Breadcrumb Area End ***** -->

  <!-- ****** About Us Area Start ******* -->
  <section class="dento-about-us-area mt-70">
    <div class="container">
      <div class="row align-items-center">
        <!-- About Us Thumbnail -->
        <div class="col-12 col-md-6">
          <div class="about-us-thumbnail mb-50">
            <img src="./img/bg-img/15.jpg" alt="">
          </div>
        </div>
        <!-- About Content -->
        <div class="col-12 col-md-12">
          <div class="about-us-content mb-50">
            <!-- Section Heading -->
            <div class="section-heading">
              <h2>Jadwal</h2>
              <div class="line"></div>
            </div>
          
              <table class="table table-borderless mb-0 table-bordered table-hover">
                <thead >
                    <tr >
                        <th width = "5%">No.</th>
                        <th>Tanggal</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    @foreach ($data['jadwal'] as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('l, d F Y', strtotime($item->tanggal ))}} </td>
                            <td>{{ $item->jam_buka }}</td>
                            <td>{{ $item->jam_tutup }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->keterangan }}</td>
                            
                        </tr>
                    @endforeach
                    
                </tbody>
              </table>
           
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ****** About Us Area End ****** -->


@endsection