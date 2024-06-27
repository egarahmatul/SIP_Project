<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataBidanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Bidan",
            'users' => User::where('hak_akses', 'bidan')->get(),
        ];

        return view('admin/databidan')->with('data', $data);
    }



    public function insert(Request $request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'hak_akses' => 'bidan',
            'aktiv' => '1',
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ];


        User::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id = $request->id;
      
            
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function non_aktiv(Request $request){

        $id = $request->id;
      
            
        $data = [
            'aktiv' => $request->aktiv,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }


}
