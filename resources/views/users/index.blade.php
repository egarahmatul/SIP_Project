@extends('template_users.master')
@section('contents')

<!-- ***** Welcome Area Start ***** -->
<section class="dento-about-us-area section-padding-30-0" style="background-color:#00aeef;">
  <div class="container">
    <div class="row align-items-center">
    <div class="col-12 col-md-6">
        <div class="about-us-content mb-50">
          <!-- Section Heading -->
          <div class="section-heading">
            <h2>Sistem Informasi Posyandu Gurun</h2>
            <div class="line" style="height: 5px;background-color: white;margin: 20px 0; "></div>
          </div>
          <p style="color:white;">Selamat Datang di Sistem Informasi Posyandu Gurun. Posyandu Gurun berada di Jorong Gobah Bukik Batabuah, Kabupaten Agam.
            Sistem Informasi Posyandu yang terintegrasi dengan dashboard kader, petugas puskesmas dan bisa dikelola oleh Bidan Posyandu.Sistem ini
            terhubung dengan dashboard kader yang bisa membantu kegiatan pengelolaan data di Posyandu.
          </p>
        </div>
      </div>
      <!-- About Us Thumbnail -->
      <div class="col-12 col-md-6">
        <div class="about-us-thumbnail mb-50">
          <img src="{{asset('assets/dashboard.png')}}" width="80%" alt="">
        </div>
      </div>
</section>
<!-- ***** Welcome Area End ***** -->

<!-- ****** About Us Area Start ******* -->
<section class="dento-about-us-area section-padding-100-0">
  <div class="container">
    <div class="row align-items-center">
      <!-- About Us Thumbnail -->
      <div class="col-12 col-md-6">
        <div class="about-us-thumbnail mb-50">
          <img src="{{asset('assets/aboutUs.png')}}" width="150%" alt="">
        </div>
      </div>
      <!-- About Content -->
      <div class="col-12 col-md-6">
        <div class="about-us-content mb-50">
          <!-- Section Heading -->
          <div class="section-heading">
            <h2>About ePosyandu</h2>
            <div class="line"></div>
          </div>
          <p>PT Infokes Indonesia mulai melakukan implementasi produk ePuskesmas 
            semenjak tahun 2013, sampai saat ini lebih dari 1000 puskesmas dan 
            50 Dinkes Kota / Kabupaten di Indonesia telah menggunakan produk tersebut. 
            Untuk meningkatkan kualitas, performa produk dan layanan team Infokes terus
             melakukan inovasi dan transformasi dengan menghadirkan ePosyandu. </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ****** About Us Area End ****** -->

<!-- ****** Featured Start ******* -->
<section class="dento-about-us-area section-padding-100-0">
  <div class="container">
    <div class="row align-items-center">
    <div class="col-12 col-md-6">
        <div class="about-us-content mb-50">
          <!-- Section Heading -->
          <div class="section-heading">
            <h2>Featured ePosyandu</h2>
            <div class="line"></div>
          </div>
          <p>Terintegrasi dengan dashboard kader, petugas puskesmas dan bisa dikelola oleh Bidan Posyandu.Sistem ini
            terhubung dengan dashboard kader yang bisa membantu kegiatan pengelolaan data di Posyandu.
          </p>
        </div>
      </div>
      <!-- About Us Thumbnail -->
      <div class="col-12 col-md-6">
        <div class="about-us-thumbnail mb-50">
          <img src="{{asset('assets/dashboard2.png')}}" width="80%" alt="">
        </div>
      </div>
      <!-- About Content -->
      
    </div>
  </div>
</section>
<!-- ****** Featured End ****** -->

<div class="container">
  <div class="dento-border clearfix"></div>
</div>

<!-- Cool Facts Area Start -->
<section class="dento-cta-area">
  <div class="container">
    <div class="row">
      <!-- Cool Facts Area -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cta text-center mt-50 mb-100">
          <i class="icon_genius"></i>
          <h2><span class="counter">{{$data['jumlah_bidan']}}</span></h2>
          <h5>Jumlah Bidan</h5>
        </div>
      </div>

      <!-- Cool Facts Area -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cta text-center mt-50 mb-100">
          <i class="icon_heart_alt"></i>
          <h2><span class="counter">{{$data['jumlah_balita']}}</span></h2>
          <h5>Jumlah Balita</h5>
        </div>
      </div>

      <!-- Cool Facts Area -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cta text-center mt-50 mb-100">
          <i class="icon_book_alt"></i>
          <h2><span class="counter">{{$data['jumlah_jadwal']}}</span></h2>
          <h5>Jumlah Jadwal</h5>
        </div>
      </div>

      <!-- Cool Facts Area -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="single-cta text-center mt-50 mb-100">
          <i class="icon_id"></i>
          <h2><span class="counter">{{ $data['jumlah_pemeriksaan']}}</span></h2>
          <h5>Jumlah Pemeriksaan</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Cool Facts Area End -->


<!-- Dento Pricing Table Area Start -->

<!-- Dento Pricing Table Area End -->



@endsection