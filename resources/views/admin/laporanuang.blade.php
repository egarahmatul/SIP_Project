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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created</th> 
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; $total = 0;?>
                        @foreach ($data['donasi_uang'] as $item)
                        <?php $total += $item->jumlah ?>
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->created_at}}</td>
                                <td class="text-right">Rp. {{number_format($item->jumlah, 0)}}</td>
                            
                               
                            </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"></th>
                            <th class="text-right">Rp {{number_format($total, 0)}}</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</section>


@endsection
