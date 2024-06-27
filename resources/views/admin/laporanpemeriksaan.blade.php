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
        <div class="card">
            <div class="card-header">
                <h4>Filter Data Pemeriksaan</h4>
            </div>
            <div class="card-body">
                <form action="{{url('filter-laporan')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Dari Tanggal</label>
                            <input type="date" name="dari_tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Sampai Tanggal</label>
                            <input type="date" name="sampai_tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <button type="submit" name = "button" value = "filter" class="btn btn-primary mt-4">Filter</button>
                        <button  type="submit" name = "button" value = "cetak" class="btn btn-warning mt-4">Cetak</button>
                        <a href="{{url('laporan-pemeriksaan')}}" class="btn btn-danger mt-4">Reset</a>
                    </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Nama Bayi</th>
                            <th>Orang Tua</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Lingkar Kepala</th>
                            <th>TB / BB</th>
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
                                <td>{{ $item->nama_balita }} </td>
                                <td>{{ $item->name }} </td>
                                <td>{{ $item->tanggal_pemeriksaan }} </td>
                                <td>{{ $item->lingkar_kepala }} cm</td>
                                <td>{{ $item->tinggi_badan }} cm / {{ $item->berat_badan }} kg</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



@endsection