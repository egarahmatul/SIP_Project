<html>
<head>
    <title>Cetak Laporan</title>
    <style type= "text/css">
    body {font-family: arial; background-color : #ccc }
    .rangkasurat {width : 980px;margin:0 auto;background-color : #fff;height: 500px;padding: 20px;}
    table {border-bottom : 5px solid # 000; padding: 2px}
    .tengah {text-align : center;line-height: 5px;}
    .tanda-tangan {
        width: 300px;
        text-align: center;
        float: right;
        margin-top: 50px;
    
     </style >
</head>
<body>
<div class = "rangkasurat">
     <table width = "100%">
           <tr>
                 <td> <img src="{{asset('assets/logo.png')}}" width="140px"> </td>
                 <td class = "tengah">
                       <h2>LAPORAN PEMERIKSAAN BALITA TAHUN {{date("Y")}}</h2>
                       <h4>Posyandu Gurun</h4>
                       <b>Dusun Gurun, Jorong Gobah, Bukik Batabuah</b>
                 </td>
            </tr>
     </table >
     <hr>

     <br>
     <h4 style="text-align: center;">Laporan Pemeriksaan Posyandu</h4>
     <table id="myTable2" border="1" style="border-collapse:collapse;" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #ccc;">
                <th width = "5%">No.</th>
                <th>Nama Bayi</th>
                <th>Orang Tua</th>
                <th>Tanggal Pemeriksaan</th>
                <th>Lingkar Kepala</th>
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th>Imunisasi</th>
                <th>Vitamin</th>
                <th>Obat Cacing</th>
                <th>Status Berat Badan</th>
                <th>Status Tinggi Badan</th>
                
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
                    <td>{{ $item->berat_badan }} kg </td>
                    <td>{{ $item->tinggi_badan }} cm </td>
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
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- kolom ttd -->
    <div class="tanda-tangan">
        <p>Canduang, {{ date("d-m-Y") }}</p>
        <br><br><br>
      
        <p><b>({{ Auth::user()->name }})</b></p>
    </div>
    
</div>

<script>
    window.print();
</script>
</body>
</html>