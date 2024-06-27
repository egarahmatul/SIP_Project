@extends('template.master')
@section('contents')


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
                <h5>Tambah Pemeriksaan</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('insert-pemeriksaan') }} " method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Balita</label>
                                <select class="custom-select" name="id_balita" id="">
                                    <option value = "">--Pilih Balita--</option>
                                    @foreach ($data['data_balita'] as $item)
                                        <option value="<?= $item->id_balita?>"><?= $item->nama_balita?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Umur</label>
                                <!-- <select class="custom-select" name="umur" id="">
                                    <option value = "">--Pilih Umur--</option>
                                    @for ($i = 1; $i <= 60; $i++)
                                        <option value = "{{$i}}">{{$i}} Bulan</option>
                                    @endfor
                                </select> -->

                                <select class="custom-select" name="umur" id="umur">
                                    <option value="">--Pilih Umur--</option>
                                    @for ($i = 1; $i <= 60; $i++)
                                        <option value="{{$i}}">{{$i}} Bulan</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="">Tanggal Pemeriksaan</label>
                      <input type="date" name="tanggal_pemeriksaan" id="" class="form-control" placeholder="" required>
                    </div>
                    
                    <label for="">Data Pemeriksaan</label>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Lingkar Kepala (cm)</label>
                                <input type="number" name="lingkar_kepala" id="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" id="berat_badan" class="form-control" step="0.01" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="calculateStatusGizi()">Status Berat Badan</button>
                                <input type="text" name="status_gizi" id="status_gizi" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" id="tinggi_badan" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="calculateStatusTinggi()">Status Tinggi Badan</button>
                                <input type="text" name="status_tinggi" id="status_tinggi" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cara Ukur</label>
                                <select name="cara_ukur" class="form-control" id="" required>
                                    <option value="">--cara Ukur--</option>
                                    <option value="Telentang">Telentang</option>
                                    <option value="Berdiri">Berdiri</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Imunisasi</label>
                                <!-- <input type="text" name="imunisasi" id="" class="form-control" placeholder="" required> -->
                                <select name="imunisasi" class="form-control" id="" required>
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
                                <!-- <input type="text" name="vitamin" id="" class="form-control" placeholder="" required> -->
                                <select name="vitamin" class="form-control" id="" required>
                                    <option value="">--Pilih Vitamin--</option>
                                    <option value="Vit A">Vit A</option>
                                    <option value="Vit D">Vit D</option>
                                    <option value="Vit C">Vit C</option>
                                    <option value="Vit B">Vit B Kompleks</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Obat Cacing</label>
                                <!-- <input type="text" name="obat_cacing" id="" class="form-control" placeholder="" required> -->
                                <select name="obat_cacing" class="form-control" id="" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Saran</label>
                                <textarea class="form-control" name="saran" id="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                      <label for="">Saran</label>
                      <textarea class="form-control" name="saran" id="" rows="3"></textarea>
                    </div> -->

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function calculateStatusGizi() {
        var umur = parseInt(document.getElementById('umur').value);
        var berat_badan = parseFloat(document.getElementById('berat_badan').value);
        var statusGizi = '';

        if (umur === 1) {
            if (berat_badan >= 2.7 && berat_badan <= 3.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 3.6 && berat_badan <= 4.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 5.5 && berat_badan <= 6.2) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 2) {
            if (berat_badan >= 3.4 && berat_badan <= 3.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 4.5 && berat_badan <= 5.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 6.6 && berat_badan <= 7.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 3) {
            if (berat_badan >= 4.0 && berat_badan <= 4.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 5.2 && berat_badan <= 6.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 7.5 && berat_badan <= 8.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 4) {
            if (berat_badan >= 4.4 && berat_badan <= 5.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 5.7 && berat_badan <= 7.3) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 8.2 && berat_badan <= 9.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 5) {
            if (berat_badan>= 4.8 && berat_badan <= 5.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 6.1 && berat_badan <= 7.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 8.8 && berat_badan <= 10.0) {
                statusGizi = 'Gizi Buruk';
            }
        }   else if (umur === 6) {
            if (berat_badan >= 5.1 && berat_badan <= 5.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 6.5 && berat_badan <= 8.2) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 9.3 && berat_badan <= 10.6) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 7) {
            if (berat_badan >= 5.3 && berat_badan <= 6.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 6.8 && berat_badan <= 8.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 9.8 && berat_badan <= 11.1) {
                statusGizi = 'Gizi Normal';
            }
        } else if (umur === 8) {
            if (berat_badan >= 5.6 && berat_badan <= 6.3) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 7.0 && berat_badan <= 9.0) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 10.2 && berat_badan <= 11.6) {
                statusGizi= 'Gizi Buruk';
            }
        } else if (umur === 9) {
            if (berat_badan >= 5.8 && berat_badan <= 6.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 7.3 && berat_badan <= 9.3) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 10.5 && berat_badan <= 12.0) {
                statusGizi= 'Gizi Buruk';
            }
        } else if (umur === 10) {
            if (berat_badan >= 5.9 && berat_badan <= 6.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan>= 7.5 && berat_badan <= 9.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 10.9 && berat_badan <= 12.4) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 11) {
            if (berat_badan >= 6.1 && berat_badan <= 6.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 7.7 && berat_badan <= 9.9) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 11.2 && berat_badan <= 12.8) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 12) {
            if (berat_badan >= 6.3 && berat_badan <= 7.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 7.9 && berat_badan <= 10.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 11.5 && berat_badan <= 13.1) {
                statusGizi= 'Gizi Buruk';
            }
        } else if (umur === 13) {
            if (berat_badan >= 6.4 && berat_badan <= 7.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 8.1 && berat_badan <= 10.4) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 11.8 && berat_badan <= 13.5) {
                statusGizi = 'Gizi Buruk';
            }
        }  else if (umur === 14) {
            if (berat_badan >= 6.6 && berat_badan <= 7.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 8.3 && berat_badan <= 10.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 12.1 && berat_badan <= 13.8) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 15) {
            if (berat_badan >= 6.7 && berat_badan <= 7.6) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 8.5 && berat_badan <= 10.9) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 12.4 && berat_badan <= 14.1) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 16) {
            if (berat_badan >= 6.9 && berat_badan <= 7.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 8.7 && berat_badan <= 11.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 12.6 && berat_badan <= 14.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 17) {
            if (berat_badan >= 7.0 && berat_badan <= 7.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 8.9 && berat_badan <= 11.4) {
                statusGizi= 'Gizi Normal';
            } else if (berat_badan >= 12.9 && berat_badan <= 14.8) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 18) {
            if (berat_badan >= 7.2 && berat_badan <= 8.1) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 9.1 && berat_badan <= 11.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 13.2 && berat_badan <= 15.1) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 19) {
            if (berat_badan >= 7.3 && berat_badan <= 8.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 9.2 && berat_badan <= 11.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 13.5 && berat_badan <= 15.4) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 20) {
            if (berat_badan >= 7.5 && berat_badan <= 8.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 9.4 && berat_badan <= 12.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 13.7 && berat_badan <= 15.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 21) {
            if (berat_badan >= 7.6 && berat_badan <= 8.6) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 9.6 && berat_badan <= 12.3) {
                status_gizi = 'Gizi Normal';
            } else if (berat_badan >= 14.0 && berat_badan <= 16.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 22) {
            if (berat_badan >= 7.8 && berat_badan <= 8.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 9.8 && berat_badan <= 12.5) {
                status_gizi = 'Gizi Normal';
            } else if (berat_badan >= 14.3 && berat_badan <= 16.4) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 23) {
            if (berat_badan >= 7.9 && berat_badan <= 8.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.0 && berat_badan <= 12.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 14.6 && berat_badan <= 16.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 24) {
            if (berat_badan >= 8.1 && berat_badan <= 9.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.2 && berat_badan <= 13.0) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 14.8 && berat_badan <= 17.0) {
                statusGizi= 'Gizi Buruk';
            }
        } else if (umur === 25) {
            if (berat_badan >= 8.2 && berat_badan <= 9.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.3 && berat_badan <= 13.3) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 15.1 && berat_badan <= 17.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 26) {
            if (berat_badan >= 8.4 && berat_badan <= 9.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.5 && berat_badan <= 13.5) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 15.4 && berat_badan <= 17.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 27) {
            if (berat_badan >= 8.5 && berat_badan <= 9.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.7 && berat_badan <= 13.7) {
               statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 15.7 && berat_badan <= 18.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 28) {
            if (berat_badan >= 8.6 && berat_badan <= 9.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 10.9 && berat_badan <= 14.0) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 16.0 && berat_badan <= 18.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 29) {
            if (berat_badan >= 8.8 && berat_badan <= 9.8) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.1 && berat_badan <= 14.2) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 16.2 && berat_badan <= 18.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 30) {
            if (berat_badan >= 8.9 && berat_badan <= 10.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.2 && berat_badan <= 14.4) {
                status_gizi = 'Gizi Normal';
            } else if (berat_badan >= 16.5 && berat_badan <= 19.0) {
                status_gizi = 'Gizi Buruk';
            }
        } else if (umur === 31) {
            if (berat_badan >= 9.0 && berat_badan <= 10.1) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.4 && berat_badan <= 14.7) {
               statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 16.8 && berat_badan <= 19.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur == 32) {
            if (berat_badan >= 9.1 && berat_badan <= 10.3) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.6 && berat_badan <= 14.9) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 17.1 && berat_badan <= 19.6) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 33) {
            if (berat_badan >= 9.3 && berat_badan <= 10.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.7 && berat_badan <= 15.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 17.3 && berat_badan <= 20.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 34) {
            if (berat_badan >= 9.4 && berat_badan <= 10.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 11.9 && berat_badan <= 15.4) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 17.6 && berat_badan <= 20.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 35) {
            if (berat_badan >= 9.5 && berat_badan <= 10.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.0 && berat_badan <= 15.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 17.9 && berat_badan <= 20.6) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 36) {
            if (berat_badan >= 9.6 && berat_badan <= 10.8) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.2 && berat_badan <= 15.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 18.1 && berat_badan <= 20.9) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 37) {
            if (berat_badan >= 9.7 && berat_badan <= 10.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.4 && berat_badan <= 16.0) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 18.4 && berat_badan <= 21.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 38) {
            if (berat_badan >= 9.8 && berat_badan <= 11.1) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.5 && berat_badan <= 16.3) {
                statusGizi= 'Gizi Normal';
            } else if (berat_badan >= 18.7 && berat_badan <= 21.6) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 39) {
            if (berat_badan >= 9.9 && berat_badan <= 11.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.7 && berat_badan <= 16.5) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 19.0 && berat_badan <= 22.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 40) {
            if (berat_badan >= 10.1 && berat_badan <= 11.3) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 12.8 && berat_badan <= 16.7) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 19.2 && berat_badan <= 22.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 41) {
            if (berat_badan >= 10.2 && berat_badan <= 11.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.0 && berat_badan <= 16.9) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 19.5 && $berat_badan <= 22.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 42) {
            if (berat_badan >= 10.3 && berat_badan <= 11.6) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.1 && berat_badan <= 17.2) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 19.8 && berat_badan <= 23.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 43) {
            if (berat_badan >= 10.4 && berat_badan <= 11.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.3 && berat_badan <= 17.4) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 20.1 && berat_badan <= 23.4) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 44) {
            if (berat_badan >= 10.5 && berat_badan <= 11.8) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.4 && berat_badan <= 17.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 20.4 && berat_badan <= 23.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 45) {
            if (berat_badan >= 10.6 &&berat_badan <= 12.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.6 && berat_badan <= 17.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 20.7 && berat_badan <= 24.1) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 46) {
            if (berat_badan >= 10.7 && berat_badan <= 12.1) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.7 && berat_badan <= 18.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 20.9 && berat_badan <= 24.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 47) {
            if (berat_badan >= 10.8 && berat_badan <= 12.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 13.9 && berat_badan <= 18.3) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 21.2 && berat_badan <= 24.8) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 48) {
            if (berat_badan >= 10.9 && berat_badan <= 12.3) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.0 && berat_badan <= 18.5) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 21.5 && berat_badan <= 25.2) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 49) {
            if (berat_badan >= 11.0 && berat_badan <= 12.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.2 && berat_badan <= 18.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 21.8 && berat_badan <= 25.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 50) {
            if (berat_badan >= 11.1 && berat_badan <= 12.6) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.3 && berat_badan <= 19.00) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 22.1 && berat_badan <= 25.9) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 51) {
            if (berat_badan >= 11.2 && berat_badan <= 12.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.5 && berat_badan <= 19.2) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 22.4 && berat_badan <= 26.3) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 52) {
            if (berat_badan >= 11.3 && berat_badan <= 12.8) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.6 && berat_badan <= 19.4) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 22.6 && berat_badan <= 26.6) {
                statusGizi = 'Gizi Buruk';
            }
        }   else if (umur === 53) {
            if (berat_badan >= 11.4 && berat_badan <= 12.9) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.8 && berat_badan <= 19.7) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 22.9 && berat_badan <= 27.0) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 54) {
            if (berat_badan >= 11.5 && berat_badan <= 13.0) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 14.9 && berat_badan <= 19.9) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 23.2 && berat_badan <= 27.4) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 55) {
            if (berat_badan >= 11.6 && berat_badan <= 13.2) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.1 && berat_badan <= 20.1) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 23.5 && berat_badan <= 27.7) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 56) {
            if (berat_badan >= 11.7 && berat_badan <= 13.3) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.2 && berat_badan <= 20.3) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 23.8 && berat_badan <= 28.1) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 57) {
            if (berat_badan >= 11.8 && berat_badan <= 13.4) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.3 && berat_badan <= 20.6) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 24.1 && berat_badan <= 28.5) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 58) {
            if (berat_badan >= 11.9 && berat_badan <= 13.5) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.5 && berat_badan <= 20.8) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 24.4 && berat_badan <= 28.8) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 59) {
            if (berat_badan >= 12.0 && berat_badan <= 13.6) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.6 && berat_badan <= 21.0) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 24.6 && berat_badan <= 29.2) {
                statusGizi = 'Gizi Buruk';
            }
        } else if (umur === 60) {
            if (berat_badan >= 12.1 && berat_badan <= 13.7) {
                statusGizi = 'Gizi Kurang';
            } else if (berat_badan >= 15.8 && berat_badan <= 21.2) {
                statusGizi = 'Gizi Normal';
            } else if (berat_badan >= 24.9 && berat_badan <= 29.5) {
                statusGizi = 'Gizi Buruk';
            }    
        } else {
            statusGizi = 'Tidak Normal';
        } 

        document.getElementById('status_gizi').value = statusGizi;
    }

    // Panggil fungsi calculateStatusGizi saat nilai umur atau berat badan berubah
    document.getElementById('umur').addEventListener('change', calculateStatusGizi);
    document.getElementById('berat_badan').addEventListener('change', calculateStatusGizi);

    function calculateStatusTinggi() {
        var umur = parseInt(document.getElementById('umur').value);
        var tinggi_badan = parseFloat(document.getElementById('tinggi_badan').value);
        var statusTinggi = '';

        if (umur === 1) {
               if (tinggi_badan >= 48.9 && tinggi_badan <= 50.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 50.9 && tinggi_badan <= 56.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 56.8 && tinggi_badan <= 60.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 2) {
               if (tinggi_badan >= 51.0 && tinggi_badan <= 54.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 54.5 && tinggi_badan <= 60.4) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 60.5 && tinggi_badan <= 64.4) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 3) {
               if (tinggi_badan >= 54.5 && tinggi_badan <= 57.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 57.4 && tinggi_badan <= 63.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 63.6 && tinggi_badan <= 67.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 4) {
               if (tinggi_badan >= 57.5 && tinggi_badan <= 59.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 59.8 && tinggi_badan <= 66.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 66.1 && tinggi_badan <= 70.1) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 5) {
               if (tinggi_badan >= 59.8 && tinggi_badan <= 61.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 61.8 && tinggi_badan <= 68.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 68.1 && tinggi_badan <= 72.2) {
                   statusTinggi = 'Gizi Buruk';
           }   else if (umur === 6) {
               if (tinggi_badan >= 61.9 && tinggi_badan <= 63.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 63.4 && tinggi_badan <= 69.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 69.9 && tinggi_badan <= 74.0) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 7) {
               if (tinggi_badan >= 63.4 && tinggi_badan <= 64.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 64.9 && tinggi_badan <= 71.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 71.4 && tinggi_badan <= 75.7) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 8) {
               if (tinggi_badan >= 65.0 && tinggi_badan <= 66.2) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 66.3 && tinggi_badan <= 72.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 72.9 && tinggi_badan <= 75.7) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 9) {
               if (tinggi_badan >= 66.3 && tinggi_badan <= 67.5) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 67.6 && tinggi_badan <= 74.2) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 74.3 && tinggi_badan <= 78.7) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 10) {
               if (tinggi_badan >= 67.7 && tinggi_badan <= 68.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 68.8 && tinggi_badan <= 75.6) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 75.7 && tinggi_badan <= 80.1) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 11) {
               if (tinggi_badan >= 68.8 && tinggi_badan <= 69.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 70.0 && tinggi_badan <= 76.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 77.0 && tinggi_badan <= 81.5) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 12) {
               if (tinggi_badan >= 70.1 && tinggi_badan <= 71.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 71.1 && tinggi_badan <= 78.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 78.2 && tinggi_badan <= 82.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 13) {
               if (tinggi_badan >= 71.2 && tinggi_badan <= 72.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 72.2 && tinggi_badan <= 79.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 79.4 && tinggi_badan <= 84.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           }  else if (umur === 14) {
               if (tinggi_badan >= 72.3 && tinggi_badan <= 73.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 73.2 && tinggi_badan <= 80.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 80.6 && tinggi_badan <= 85.5) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 15) {
               if (tinggi_badan >= 73.3 && tinggi_badan <= 74.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 74.2 && tinggi_badan <= 81.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 81.2 && tinggi_badan <= 86.7) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 16) {
               if (tinggi_badan >= 74.3 && tinggi_badan <= 75.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 75.1 && tinggi_badan <= 82.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 82.9 && tinggi_badan <= 88.0) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 17) {
               if (tinggi_badan >= 75.2 && tinggi_badan <= 76.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 76.1 && tinggi_badan <= 83.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 84.0 && tinggi_badan <= 89.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 18) {
               if (tinggi_badan >= 76.2 && tinggi_badan <= 76.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 77.0 && tinggi_badan <= 85.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 85.1 && tinggi_badan <= 90.4) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 19) {
               if (tinggi_badan >= 77.1 && tinggi_badan <= 77.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 77.8 && tinggi_badan <= 86.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 86.1 && tinggi_badan <= 91.5) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 20) {
               if (tinggi_badan >= 77.9 && tinggi_badan <= 78.6) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 78.9 && tinggi_badan <= 87.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 87.1 && tinggi_badan <= 92.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 21) {
               if (tinggi_badan >= 77.0 && tinggi_badan <= 79.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 79.5 && tinggi_badan <= 88.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 88.1 && tinggi_badan <= 93.8) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 22) {
               if (tinggi_badan >= 79.6 && tinggi_badan <= 80.2) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 80.3 && tinggi_badan <= 89.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 89.1 && tinggi_badan <= 94.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 23) {
               if (tinggi_badan >= 80.4 && tinggi_badan <= 81.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 81.1 && tinggi_badan <= 89.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 90.0 && tinggi_badan <= 95.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 24) {
               if (tinggi_badan >= 78.0 && tinggi_badan <= 81.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 81.1 && tinggi_badan <= 90.2) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 90.3 && tinggi_badan <= 96.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 25) {
               if (tinggi_badan >= 78.6 && tinggi_badan <= 81.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 81.8 && tinggi_badan <= 91.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 91.2 && tinggi_badan <= 97.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 26) {
               if (tinggi_badan >= 79.3 && tinggi_badan <= 82.5) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 82.6 && tinggi_badan <= 92.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 92.1 && tinggi_badan <= 98.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 27) {
               if (tinggi_badan >= 79.9 && tinggi_badan <= 83.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 83.2 && tinggi_badan <= 92.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 93.0 && tinggi_badan <= 99.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 28) {
               if (tinggi_badan >= 80.5 && tinggi_badan <= 83.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 83.9 && tinggi_badan <= 93.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 93.8 && tinggi_badan <= 100.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 29) {
               if (tinggi_badan >= 81.1 && tinggi_badan <= 84.5) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 84.6 && tinggi_badan <= 94.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 94.6 && tinggi_badan <= 101.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 30) {
               if (tinggi_badan >= 81.7 && tinggi_badan <= 85.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 85.2 && tinggi_badan <= 95.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 95.4 && tinggi_badan <= 102.1) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 31) {
               if (tinggi_badan >= 82.3 && tinggi_badan <= 85.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 85.8 && tinggi_badan <= 96.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 96.2 && tinggi_badan <= 103.0) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 32) {
               if (tinggi_badan >= 82.8 && tinggi_badan <= 86.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 86.5 && tinggi_badan <= 96.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 97.0 && tinggi_badan <= 103.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 33) {
               if (tinggi_badan >= 83.4 && tinggi_badan <= 86.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 87.0 && tinggi_badan <= 97.6) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 97.7 && tinggi_badan <= 104.8) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 34) {
               if (tinggi_badan >= 83.9 && tinggi_badan <= 87.5) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 87.6 && tinggi_badan <= 98.4) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 98.5 && tinggi_badan <= 105.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 35) {
               if (tinggi_badan >= 84.4 && tinggi_badan <= 88.1) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 88.2 && tinggi_badan <= 98.4) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 98.5 && tinggi_badan <= 106.4) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 36) {
               if (tinggi_badan >= 85.0 && tinggi_badan <= 88.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 88.8 && tinggi_badan <= 99.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 99.9 && tinggi_badan <= 107.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 37) {
               if (tinggi_badan >= 85.5 && tinggi_badan <= 89.2) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 89.3 && tinggi_badan <= 100.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 100.6 && tinggi_badan <= 108.0) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 38) {
               if (tinggi_badan >= 86.0 && tinggi_badan <= 89.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 89.9 && tinggi_badan <= 101.2) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 101.3 && tinggi_badan <= 108.8) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 39) {
               if (tinggi_badan >= 86.5 && tinggi_badan <= 90.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 90.4 && tinggi_badan <= 101.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 101.9 && tinggi_badan <= 109.5) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 40) {
               if (tinggi_badan >= 87.0 && tinggi_badan <= 90.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 91.0 && tinggi_badan <= 102.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 102.6 && tinggi_badan <= 110.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 41) {
               if (tinggi_badan >= 87.5 && tinggi_badan <= 91.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 91.5 && tinggi_badan <= 103.2) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 103.3 && tinggi_badan <= 111.0) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 42) {
               if (tinggi_badan >= 88.0 && tinggi_badan <= 91.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 92.0 && tinggi_badan <= 103.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 103.9 && tinggi_badan <= 111.7) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 43) {
               if (tinggi_badan >= 88.4 && tinggi_badan <= 92.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 92.5 && tinggi_badan <= 104.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 104.6 && tinggi_badan <= 112.5) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 44) {
               if (tinggi_badan >= 88.9 && tinggi_badan <= 93.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 93.1 && tinggi_badan <= 105.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 105.2 && tinggi_badan <= 113.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 45) {
               if (tinggi_badan >= 89.4 && tinggi_badan <= 93.5) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 93.6 && tinggi_badan <= 105.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 105.8 && tinggi_badan <= 113.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 46) {
               if (tinggi_badan >= 89.8 && tinggi_badan <= 94.0) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 94.1 && tinggi_badan <= 106.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 106.4 && tinggi_badan <= 114.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 47) {
               if (tinggi_badan >= 90.3 && tinggi_badan <= 94.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 94.5 && tinggi_badan <= 106.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 107.0 && tinggi_badan <= 115.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 48) {
               if (tinggi_badan >= 90.7 && tinggi_badan <= 94.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 95.0 && tinggi_badan <= 107.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 107.6 && tinggi_badan <= 115.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 49) {
               if (tinggi_badan >= 91.2 && tinggi_badan <= 95.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 95.5 && tinggi_badan <= 108.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 108.2 && tinggi_badan <= 116.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 50) {
               if (tinggi_badan >= 91.6 && tinggi_badan <= 95.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 96.0 && tinggi_badan <= 108.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 108.8 && tinggi_badan <= 117.3) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 51) {
               if (tinggi_badan >= 92.1 && tinggi_badan <= 96.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 96.5 && tinggi_badan <= 109.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 109.4 && tinggi_badan <= 117.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 52) {
               if (tinggi_badan >= 92.5 && tinggi_badan <= 96.9) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 97.0 && tinggi_badan <= 109.9) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 110.0 && tinggi_badan <= 118.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           }   else if (umur === 53) {
               if (tinggi_badan >= 93.0 && tinggi_badan <= 97.4) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 97.5 && tinggi_badan <= 110.5) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 110.6 && tinggi_badan <= 119.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 54) {
               if (tinggi_badan >= 93.4 && tinggi_badan <= 97.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 97.9 && tinggi_badan <= 111.1) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 111.2 && tinggi_badan <= 119.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 55) {
               if (tinggi_badan >= 93.9 && tinggi_badan <= 98.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 98.4 && tinggi_badan <= 111.7) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 111.8 && tinggi_badan <= 120.6) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 56) {
               if (tinggi_badan >= 94.3 && tinggi_badan <= 98.8) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 98.9 && tinggi_badan <= 112.3) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 112.4 && tinggi_badan <= 121.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 57) {
               if (tinggi_badan >= 94.7 && tinggi_badan <= 99.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 99.4 && tinggi_badan <= 112.8) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 112.9 && tinggi_badan <= 121.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 58) {
               if (tinggi_badan >= 95.2 && tinggi_badan <= 99.7) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 99.8 && tinggi_badan <= 113.4) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 113.5 && tinggi_badan <= 121.9) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 59) {
               if (tinggi_badan >= 95.6 && tinggi_badan <= 100.2) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 100.3 && tinggi_badan <= 114.0) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 114.1 && tinggi_badan <= 123.2) {
                   statusTinggi = 'Gizi Buruk';
               }
           } else if (umur === 60) {
               if (tinggi_badan >= 96.1 && tinggi_badan <= 105.3) {
                   statusTinggi = 'Gizi Kurang';
               } else if (tinggi_badan >= 105.4 && tinggi_badan <= 114.6) {
                   statusTinggi = 'Gizi Normal';
               } else if (tinggi_badan >= 114.7 && tinggi_badan <= 123.9) {
                   statusTinggi = 'Gizi Buruk';
               }
        } else {
            statusTinggi = 'Tidak Normal';
        }

        document.getElementById('status_tinggi').value = statusTinggi;
    }
    }

    // Panggil fungsi calculatestatusTinggi saat nilai umur atau tinggi badan berubah
    document.getElementById('umur').addEventListener('change', calculateStatusTinggi);
    document.getElementById('tinggi_badan').addEventListener('change', calculateStatusTinggi);
</script>

@endsection