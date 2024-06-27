@extends('template.master')
@section('contents')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    {{-- <a href="{{url('tambah-pemeriksaan')}}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Pemeriksaan</a> --}}

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
        <div class="card">
            <div class="card-header">
                <h5>Data Balita</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nama Balita</label>
                                <input type="text" name="nama_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->nama_balita}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Usia Balita</label>
                                <input type="text" name="usia_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->usia_balita}}">
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                <label for="">Tempat Lahir Balita</label>
                                <input type="text" name="tempat_lahir_balita" id="" class="form-control" required readonly value = "{{$data['data_balita']->tempat_lahir_balita}}">
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>

        <a href="{{url('tambah-pemeriksaan')}}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Pemeriksaan</a>
        
        <div class="card">
            <div class="card-header">
                <h4>Data Riwayat Pemeriksaan</h4>
            </div>
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Umur</th>
                            <th>Lingkar Kepala</th>
                            <th>Berat badan</th>
                            <th>Tinggi badan</th>
                            <th>Cara Ukur</th>
                            <th>Imunisasi</th>
                            <th>Vitamin</th>
                            <th>Obat Cacing</th>
                            <th>Status Berat Badan</th>
                            <th>Status Tinggi Badan</th>
                            <th>Saran</th>
                            <th class="text-center">Action</th>
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
                                <td>{{ $item->berat_badan }} Kg
                                <td>{{ $item->tinggi_badan }} cm</td>
                                <td>{{ $item->cara_ukur }}</td>
                                <td>{{ $item->imunisasi }}</td>
                                <td>{{ $item->vitamin }}</td>
                                <td>{{ $item->obat_cacing }}</td>
                                <td>
                                    @if ($item->status_gizi == 'Gizi Normal')
                                        <div class="badge badge-success">Normal</div>
                                    @elseif($item->status_gizi == 'Gizi Kurang')
                                        <div class="badge badge-warning">Kurang</div>
                                    @elseif($item->status_gizi == 'Gizi Buruk')
                                        <div class="badge badge-danger">Buruk</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_tinggi == 'Gizi Normal')
                                        <div class="badge badge-success">Normal</div>
                                    @elseif($item->status_tinggi == 'Gizi Kurang')
                                        <div class="badge badge-warning">Kurang</div>
                                    @elseif($item->status_tinggi == 'Gizi Buruk')
                                        <div class="badge badge-danger">Buruk</div>
                                    @endif
                                </td>
                                <td>{{ $item->saran }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id_pemeriksaan }}">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id_pemeriksaan}}">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
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
</section>

<!-- EDIT/UPDATE PEMERIKSAAN -->
@foreach ($data['data_pemeriksaan'] as $item)

<div class="modal fade" id="Update{{$item->id_pemeriksaan}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-pemeriksaan')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name = "id_pemeriksaan" value = "{{$item->id_pemeriksaan}}">
                    <input type="hidden" name = "id_balita" value = "{{$data['data_balita']->id_balita}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Balita</label>
                                <select class="custom-select" name="id_balita" id="">
                                    <option value = "{{$item->id_balita}}">{{$item->nama_balita}}</option>
                                    @foreach ($data['balita'] as $value)
                                        <option value="<?= $value->id_balita?>"><?= $value->nama_balita?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Umur</label>
                                <select class="custom-select" name="umur" id="">
                                    <option value = "{{$item->umur}}">{{$item->umur}} Bulan</option>
                                    @for ($i = 1; $i <= 60; $i++)
                                        <option value = "{{$i}}">{{$i}} Bulan</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="">Tanggal Pemeriksaan</label>
                      <input type="date" name="tanggal_pemeriksaan" id="" class="form-control" placeholder="" required value = "{{$item->tanggal_pemeriksaan}}">
                    </div>
                    
                    <label for="">Data Pemeriksaan</label>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Lingkar Kepala (cm)</label>
                                <input type="number" name="lingkar_kepala" id="" class="form-control" placeholder="" required value = "{{$item->lingkar_kepala}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" id="" class="form-control" placeholder="" required value = "{{$item->berat_badan}}">
                                <!-- <input type="number" name="beratBadan" id="beratBadan" class="form-control" placeholder="" required value = "{{$item->beratBadan}}"> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-info" onclick="calculateStatusGizi()">Status Berat Badan</button>
                                <input type="text" name="status_gizi" id="status_gizi" class="form-control" readonly value = "{{$item->status_gizi}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tinggi Badan (Cm)</label>
                                <input type="number" name="tinggi_badan" id="" class="form-control" placeholder="" required value = "{{$item->tinggi_badan}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-info" onclick="calculateStatusTinggi()">Status Tinggi Badan</button>
                                <input type="text" name="status_tinggi" id="status_tinggi" class="form-control" readonly value = "{{$item->status_tinggi}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cara Ukur</label>
                                <!-- <input type="text" name="cara_ukur" id="" class="form-control" placeholder="" required value = "{{$item->cara_ukur}}"> -->
                                <select name="caraukur" class="form-control" id="" required value = "{{$item->cara_ukur}}">
                                    <option value="">--cara Ukur--</option>
                                    <option value="Telentang">Telentang</option>
                                    <option value="Berdiri">Berdiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Imunisasi</label>
                                <!-- <input type="text" name="imunisasi" id="" class="form-control" placeholder="" required value = "{{$item->imunisasi}}"> -->
                                <select name="imunisasi" class="form-control" id="" required value = "{{$item->imunisasi}}">
                                    <option value="">--Pilih Imunisasi--</option>
                                    <option value="BCG-Polio 1">BCG-Polio 1</option>
                                    <option value="DPT-HB-HiB 1 Polio 2">DPT-HB-HiB 1 Polio 2</option>
                                    <option value="DPT-HB-Hib 2 Polio 3">DPT-HB-Hib 2 Polio 3</option>
                                    <option value="DPT-HB-Hib 3 Polio 4">DPT-HB-Hib 3 Polio 4</option>
                                    <option value="Campak">Campak</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Vitamin</label>
                                <!-- <input type="text" name="vitamin" id="" class="form-control" placeholder="" required value = "{{$item->vitamin}}"> -->
                                <select name="vitamin" class="form-control" id="" required value = "{{$item->vitamin}}">
                                    <option value="">--Pilih Vitamin--</option>
                                    <option value="Vit A">Vit A</option>
                                    <option value="Vit D">Vit D</option>
                                    <option value="Vit C">Vit C</option>
                                    <option value="Vit B Kompleks">Vit B Kompleks</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Obat Cacing</label>
                                <!-- <input type="text" name="obat_cacing" id="" class="form-control" placeholder="" required value = "{{$item->obat_cacing}}"> -->
                                <select name="obat_cacing" class="form-control" id="" required value = "{{$item->obat_cacing}}">
                                    <option value="">--Pilih--</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Saran</label>
                                    <textarea class="form-control" name="saran" id="" rows="3" value = "{{$item->saran}}">{{$item->saran}}</textarea>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DELETE PEMERIKSAAN -->
<div class="modal fade" id="Delete{{$item->id_pemeriksaan}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Mennghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-pemeriksaan/'.$item->id_pemeriksaan)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach


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
                s += '<br/>' + this.series.name + ': ' + this.y + ' kg';
                var statusGizi = dataChart.status_gizi[this.point.index]; // Mengambil status gizi berdasarkan index
                s += '<br>Status Berat Badan: ' + statusGizi; // Menambahkan status gizi ke tooltip
            } else if (this.series.name === 'Tinggi Badan') {
                s += '<br/>' + this.series.name + ': ' + this.y + ' cm';
                var statusTinggi = dataChart.status_tinggi[this.point.index]; // Mengambil status tinggi berdasarkan index
                s += '<br>Status Tinggi Badan: ' + statusTinggi; // Menambahkan status tinggi ke tooltip
            } else {
                s += '<br/>' + this.series.name + ': ' + this.y + ' cm';
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
