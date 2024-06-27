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
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Nama Orang Tua</th>
                            <th>Jumlah Pemeriksaan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['data_pemeriksaan'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_balita }}</td>
                                <td>{{ $item->usia_balita }}</td>
                                <td>{{ $item->jenis_kelamin_balita }}</td>
                                <td>{{ $item->tempat_lahir_balita }}, {{$item->tanggal_lahir_balita}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->jumlah_pemeriksaan }}</td>
                                <td class="text-center">
                                    @if ($item->jumlah_pemeriksaan > 0)
                                        <a href="<?= url('detail-pemeriksaan-bidan/'.$item->id_balita)?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        
                                    @else
                                        -
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>



@endsection
