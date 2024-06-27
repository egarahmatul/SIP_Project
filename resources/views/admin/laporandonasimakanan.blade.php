@extends('template.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    {{-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Data
    </button> --}}

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
                <h4>Filter</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Dari Tanggal</label>
                                <input type="date" name="dari_tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Sampai Tanggal</label>
                                <input type="date" name="sampai_tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-primary mt-4">Filter</button>
                            <button type="reset" class="btn btn-danger mt-4"">Reset</button>
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
                            <th>Nama Makanan</th>
                            <th>Jumlah Makanan</th>
                            <th>Jenis Makanan</th>
                            <th>Batas Kadaluarsa</th>
                            <th>Tanggal Pembuatan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Nama Panti</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['donasi_makanan'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_makanan }}</td>
                                <td>{{ $item->jumlah_makanan }}</td>
                                <td>{{ $item->jenis_makanan }}</td>
                                <td>{{ $item->batas_kadaluarsa }} Hari</td>
                                <td>{{ $item->tgl_pembuatan }}</td>
                                <td>{{ $item->status_makanan }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->nama_panti }}</td>
                                
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@foreach ($data['donasi_makanan'] as $item)
<div class="modal fade" id="Eye{{$item->id_donasi_makanan }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-request-makanan')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="hidden" name = "id_pengiriman" value="{{$item->id_pengiriman}}">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" readonly>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Data Panti</label>
                                    <input type="text" class="form-control" readonly value = "{{$item->nama_panti}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Keterangan</label>
                                <input type="text" id="keterangan_kebutuhan_update" name="" value="{{$item->keterangan}}" class="form-control keterangan_kebutuhan_update" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Kebutuhan (Pcs)</label>
                                <input type="email" id="kebutuhan_update" name="" value="{{$item->keterangan_request}}" class="form-control kebutuhan_update" readonly>
                            </div>
                            <div class="form-group">
                            <label for="">Nama Makanan</label>
                            <input type="text" name = "nama_makanan" class="form-control" required readonly value ="{{$item->nama_makanan}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2">Jumlah Makanan (Pcs)</label>
                            <input type="number" name = "jumlah_makanan" class="form-control" required readonly value ="{{$item->jumlah_makanan}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2">Jenis Makanan</label>
                            <input type="text" class="form-control" readonly value = "{{$item->jenis_makanan}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="mb-2">Tanggal Pembuatan</label>
                                    <input type="date" name = "tgl_pembuatan" class="form-control" required readonly value ="{{$item->tgl_pembuatan}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="mb-2">Batas Kadaluarsa</label>
                                    <input type="number" name = "batas_kadaluarsa" class="form-control" required readonly value ="{{$item->batas_kadaluarsa}}">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2">Komposisi Makanan</label>
                            <input type="text" name = "komposisi_makanan" class="form-control" required readonly value ="{{$item->komposisi_makanan}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-2">Packaging Makanan</label>
                            <input type="text" name = "packaging_makanan" class="form-control" required readonly value ="{{$item->packaging_makanan}}">
                        </div>
                    
                            <div class="form-group">
                                <label for="note" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5"  value ="{{$item->keterangan}}" readonly class="form-control">{{$item->keterangan}}</textarea>
                            </div>
            
                            <div class="form-group">
                                <label for="" class="mb-2">Gambar Makanan</label>
                                <br>
                                <center><img src="{{url('foto_makanan/'.$item->foto_makanan)}}" width="90%"></center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}" target="_BLANK" class="btn btn-warning">Lokasi</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Delete{{$item->id_donasi_makanan}}">
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
                    <a href="{{url('delete-request-makanan/'.$item->id_donasi_makanan)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endsection
