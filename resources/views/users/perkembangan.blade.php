@extends('template_users.master')
@section('contents') 

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

 <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-gradient-overlay" style="background-image: url({{url('assets/dashboard.png')}})">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title">Riwayat Perkembangan</h2>
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
              <li class="breadcrumb-item active" aria-current="page">Perkembangan</li>
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
       
        <div class="col-12 col-md-12">
          <div class="about-us-content mb-50">
            <!-- Section Heading -->
            <div class="section-heading">
              <h2>Perkembangan</h2>
              <div class="line"></div>
            </div>

            <div class="card" style="background-color:#3abaf4;">
                <div class="card-header">
                    <h5>Data Balita</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Balita</label>
                                    <input type="text" name="nama_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->nama_balita}}">
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Usia Balita</label>
                                    <input type="text" name="usia_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->usia_balita}}">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis Kelamin Balita</label>
                                    <input type="text" name="jenis_kelamin_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->jenis_kelamin_balita}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="text" name="tanggal_lahir_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->tanggal_lahir_balita}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tempat Balita</label>
                                    <input type="text" name="tempat_lahir_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->tempat_lahir_balita}}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h5>Riwayat Pemeriksaan</h5>
                </div>
                <div class="card-body table-responsive">
                    <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead >
                            <tr >
                                <th width = "5%">No.</th>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Umur</th>
                                <th>Lingkar Kepala</th>
                                <th>Berat Badan</th>
                                <th>Tinggi Badan</th>
                                <th>Cara Ukur</th>
                                <th>Imunisasi</th>
                                <th>Vitamin</th>
                                <th>Obat Cacing</th>
                                <th>Status Berat Badan</th>
                                <th>Status Tinggi Badan</th>
                                <th>Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($data['data_pemeriksaan'] as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->tanggal_pemeriksaan }} </td>
                                    <td>{{ $item->umur }} Bulan </td>
                                    <td>{{ $item->lingkar_kepala }} cm</td>
                                    <td>{{ $item->berat_badan }} kg </td>
                                    <td>{{ $item->tinggi_badan }} cm </td>
                                    <td>{{ $item->cara_ukur }}</td>
                                    <td>{{ $item->imunisasi }}</td>
                                    <td>{{ $item->vitamin }}</td>
                                    <td>{{ $item->obat_cacing }}</td>
                                    <td>
                                        @if ($item->status_gizi == 'Gizi Normal')
                                            <div class="badge badge-success">Gizi Normal</div>
                                        @elseif($item->status_gizi == 'Gizi Kurang')
                                            <div class="badge badge-warning">Gizi Kurang</div>
                                        @elseif($item->status_gizi == 'Gizi Buruk')
                                            <div class="badge badge-danger">Gizi Buruk</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_tinggi == 'Gizi Normal')
                                            <div class="badge badge-success">Gizi Normal</div>
                                        @elseif($item->status_tinggi == 'Gizi Kurang')
                                            <div class="badge badge-warning">Gizi Kurang</div>
                                        @elseif($item->status_tinggi == 'Gizi Buruk')
                                            <div class="badge badge-danger">Gizi Buruk</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->saran }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-5">
              <div class="card-header">
                  <h4>Grafik</h4>
              </div>
              <div class="card-body">
                  <figure class="highcharts-figure">
                      <div id="container"></div>
                      <p class="highcharts-description">
                         
                  
                          {{-- The chart is making use of the axis crosshair feature, to highlight
                          the hovered country. --}}
                      </p>
                  </figure>
              </div>
          </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ****** About Us Area End ****** -->


  <!-- GRAFIK PEMERIKSAAN -->
<script>
// Data dari backend
var dataChart = <?php echo json_encode($data['chart']); ?>;

Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Data Grafik Riwayat Pemeriksaan',
        align: 'center'
    },
    xAxis: {
        categories: dataChart.tanggal_pemeriksaan.map(function (tanggal) {
            return tanggal + ' Bulan';
        }),
        crosshair: true,
        accessibility: {
            description: 'Negara'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        formatter: function () {
            var s = '<b>' + this.x + '</b>';
            if (this.series.name === 'Berat Badan') {
                s += '<br/>' + this.series.name + ': ' + this.y + ' cm/kg';
                var statusGizi = dataChart.status_gizi[this.point.index]; // Mengambil status gizi berdasarkan index
                s += '<br>Status Berat Badan: ' + statusGizi; // Menambahkan status gizi ke tooltip
            } else {
                s += '<br/>' + this.series.name + ': ' + this.y + ' cm/kg';
            }
            return s;
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Tinggi Badan',
            data: dataChart.tinggi_badan
        },
        {
            name: 'Berat Badan',
            data: dataChart.berat_badan
        },
        {
            name: 'Lingkar Kepala',
            data: dataChart.lingkar_kepala
        }
    ]
});
</script>

@endsection