@extends('template.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>

    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Data
    </button>

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
                            <th>Tanggal</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['data_jadwal'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ date('l, d F Y', strtotime($item->tanggal ))}} </td>
                                <td>{{ $item->jam_buka }}</td>
                                <td>{{ $item->jam_tutup }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id_jadwal }}">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id_jadwal}}">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('insert-jadwal')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name = "tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jam Buka</label>
                        <input type="time" name = "jam_buka" class="form-control" required>
                    </div>   
                    <div class="form-group">
                        <label for="">Jam Tutup</label>
                        <input type="time" name = "jam_tutup" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name = "keterangan" class="form-control" required>
                    </div>
                  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@foreach ($data['data_jadwal'] as $item)


<div class="modal fade" id="Update{{$item->id_jadwal}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-jadwal')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name = "id_jadwal" value = "{{$item->id_jadwal}}">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name = "tanggal" class="form-control" required value = "<?= $item->tanggal?>">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Buka</label>
                        <input type="time" name = "jam_buka" class="form-control" required value = "<?= $item->jam_buka?>">
                    </div>   
                    <div class="form-group">
                        <label for="">Jam Tutup</label>
                        <input type="time" name = "jam_tutup" class="form-control" required value = "<?= $item->jam_tutup?>">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name = "keterangan" class="form-control" required value = "<?= $item->keterangan?>">
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

<div class="modal fade" id="Delete{{$item->id_jadwal}}">
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
                    <a href="{{url('delete-jadwal/'.$item->id_jadwal)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endsection
