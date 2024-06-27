<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jadwal;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataJadwalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Jadwal",
            'data_jadwal' => jadwal::join('users', 'users.id', '=', 'jadwal.created_by')->get(),
        ];

        return view('admin/datajadwal')->with('data', $data);
    }


    public function insert(Request $request){

        $data = [
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];

        jadwal::insert($data);
        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id_jadwal = $request->id_jadwal;      
        $data = [
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->id,
        ];

        jadwal::where('id_jadwal', $id_jadwal )->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_jadwal){
        jadwal::where('id_jadwal', $id_jadwal)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }
    

}
