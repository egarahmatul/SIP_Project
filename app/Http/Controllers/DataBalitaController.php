<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataBalitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Balita",
            'balita' => Balita::join('users', 'users.id', '=', 'balita.id_users')->get(),
            'orangtua' => User::where('hak_akses', 'orangtua')->get(),
        ];

        return view('admin/databalita')->with('data', $data);
    }


    public function insert(Request $request){

        $data = [
            'nama_balita' => $request->nama_balita,
            'usia_balita' => $request->usia_balita,
            'jenis_kelamin_balita' => $request->jenis_kelamin_balita,
            'tanggal_lahir_balita' => $request->tanggal_lahir_balita,
            'tempat_lahir_balita' => $request->tempat_lahir_balita,
            'pb_balita' => $request->pb_balita,
            'bb_balita' => $request->bb_balita,
            'id_users' => $request->id_users,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];

        Balita::insert($data);
        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id_balita = $request->id_balita;      
        $data = [
            'nama_balita' => $request->nama_balita,
            'usia_balita' => $request->usia_balita,
            'jenis_kelamin_balita' => $request->jenis_kelamin_balita,
            'tanggal_lahir_balita' => $request->tanggal_lahir_balita,
            'tempat_lahir_balita' => $request->tempat_lahir_balita,
            'pb_balita' => $request->pb_balita,
            'bb_balita' => $request->bb_balita,
            'id_users' => $request->id_users,
            'updated_by' => Auth::user()->id,
        ];

        Balita::where('id_balita', $id_balita )->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_balita){
        Balita::where('id_balita', $id_balita)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }
    

}
