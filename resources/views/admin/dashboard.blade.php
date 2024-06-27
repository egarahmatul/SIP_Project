
@extends('template.master')
@section('contents')

  <section class="section">
    <div class="section-header">
      <h1>{{$data['title']}}</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-md-12 col-sm-12">
            @if (session()->has('err_message'))
                <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                    <strong>Error! </strong>{{ session()->get('err_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('suc_message'))
                <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                    <strong>Success! </strong>{{ session()->get('suc_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
      </div>
      <div class="row">
      <div class="col-12 mb-4">
        <div class="hero bg-primary text-white">
            <div class="row align-items-center">
                    <div class="hero-inner">
                        <h2>Welcome Back, {{ Auth::user()->name }}!</h2>
                        <p class="lead">Kelola Data Posyandu ini dengan baik dan benar!</p>
                    </div>
            </div>
        </div>
      </div>
        
        
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Bidan</h4>
              </div>
              <div class="card-body">
                {{$data['jumlah_bidan']}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Pemeriksaan</h4>
              </div>
              <div class="card-body">
                {{$data['jumlah_pemeriksaan']}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-certificate"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Jadwal</h4>
              </div>
              <div class="card-body">
                  {{$data['jumlah_jadwal']}}
              </div>
            </div>
          </div>
        </div>            
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Balita</h4>
              </div>
              <div class="card-body">
                  {{$data['jumlah_balita']}}
              </div>
            </div>
          </div>
        </div>                  
      </div>
      <div class="row">    
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
            <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Gizi Baik</h4>
              </div>
              <div class="card-body">
                {{$data['jumlah_gizi_baik']}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
            <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Gizi Kurang</h4>
              </div>
              <div class="card-body">
                {{$data['jumlah_gizi_kurang']}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
            <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Gizi Buruk</h4>
              </div>
              <div class="card-body">
                  {{$data['jumlah_gizi_buruk']}}
              </div>
            </div>
          </div>
        </div>                  
      </div>
        
    </div>
  </section>
</div>

@endsection