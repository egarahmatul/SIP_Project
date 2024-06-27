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
                            <th>Usia (bulan)</th>
                            <th>PB/BB Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Nama Orang Tua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['balita'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_balita }}</td>
                                <td>{{ $item->usia_balita }}</td>
                                <td>{{ $item->pb_balita }} cm  / {{ $item->bb_balita }} kg</td>
                                <td>{{ $item->jenis_kelamin_balita }}</td>
                                <td>{{ $item->tempat_lahir_balita }}, {{$item->tanggal_lahir_balita}}</td>
                                <td>{{ $item->name }}</td>
                                
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
            <form action="{{url('insert-balita')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Balita</label>
                        <input type="text" name = "nama_balita" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Umur</label>
                                <input type="number" name = "usia_balita" class="form-control" required>
                            </div>   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name = "tempat_lahir_balita" class="form-control" required>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name = "tanggal_lahir_balita" class="form-control" required>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select name="jenis_kelamin_balita" class="form-control" id="" required>
                            <option>--Pilih Jenis Kelamin--</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>   
                    <div class="form-group">
                        <label for="">Orang Tua</label>
                        <select name="id_users" class="form-control" id="" required>
                            <option>--Pilih Orang Tua--</option>
                            @foreach ($data['orangtua'] as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">PB Balita (cm)</label>
                                <input type="number" name = "pb_balita" class="form-control" required>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BB Balita (kg)</label>
                                <input type="text" name = "bb_balita" class="form-control" required>
                            </div> 
                        </div>
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


@foreach ($data['balita'] as $item)


<div class="modal fade" id="Update{{$item->id_balita}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{url('update-balita')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" name = "id_balita" value = "{{$item->id_balita}}">
                        <input type="text" name = "nama_balita" class="form-control" value = "{{$item->nama_balita}}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Umur</label>
                                <input type="number" name = "usia_balita" class="form-control" required value = "{{$item->usia_balita}}">
                            </div>   
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name = "tempat_lahir_balita" class="form-control" required value = "{{$item->tempat_lahir_balita}}">
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name = "tanggal_lahir_balita" class="form-control" required value = "{{$item->tanggal_lahir_balita}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select name="jenis_kelamin_balita" class="form-control" id="" required>
                            <option value="{{$item->jenis_kelamin_balita}}">{{$item->jenis_kelamin_balita}}</option>
                            <?php if($item->jenis_kelamin_balita == 'laki-laki'){ ?>
                                <option value="perempuan">Perempuan</option>
                            <?php }else{ ?>
                                <option value="laki-laki">Laki-laki</option>
                            <?php } ?>
                        </select>
                    </div>   
                    <div class="form-group">
                        <label for="">Orang Tua</label>
                        <select name="id_users" class="form-control" id="" required>
                            <option value = "{{$item->id_users}}">{{$item->name}}</option>
                            @foreach ($data['orangtua'] as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">PB Balita (cm)</label>
                                <input type="number" name = "pb_balita" class="form-control" required value = "{{$item->pb_balita}}">
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BB Balita (kg)</label>
                                <input type="text" name = "bb_balita" class="form-control" required value = "{{$item->bb_balita}}">
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

<div class="modal fade" id="Delete{{$item->id_balita}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Menghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-balita/'.$item->id_balita)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endsection
