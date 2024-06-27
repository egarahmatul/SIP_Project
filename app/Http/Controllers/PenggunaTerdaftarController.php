<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webiner;
use App\Models\Kategori;
use App\Models\Materi;
use App\Models\Institusi;
use App\Models\VwWebiner;
use App\Models\VwPendaftaran;
use App\Models\VwPenggunaPendaftar;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenggunaTerdaftarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        if(Auth::user()->hak_akses == 'institusi'){
            $id_users =  Auth::user()->id;

            $data_institusi = Institusi::where('id_users', $id_users)->first();

            $id_institusi = $data_institusi->id_institusi;
         
            $data = [
                'title' => "Pengguna Pendaftar",
                'pengguna_pendaftar' => VwPenggunaPendaftar::where('id_institusi', $id_institusi)->get(),
            ];
    
            return view('institusi/datapenggunapendaftar')->with('data', $data);
        }else{
            $tgl = date('Y-m-d');
            $data = [
                'title' => "Pengguna Pendaftar",
                'pengguna_pendaftar' => VwPenggunaPendaftar::get(),
            ];
    
            return view('admin/datapenggunapendaftar')->with('data', $data);
        }
    }


    public function insert_absensi(Request $request){
        
        $id_pendaftaran = $request->id_pendaftaran;

        $data = array(
            'tgl_absensi' => Carbon::now(),
        );

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data);

        return redirect()->back()->with('suc_message', 'Anda telah melakukan absensi!');
    }

    
}
