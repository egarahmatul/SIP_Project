<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemeriksaan;
use App\Models\Balita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemeriksaaan;


class LaporanPemeriksaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => "Data Pemeriksaan",
            'data_pemeriksaan' => Balita::selectRaw('*')
                                ->Join('pemeriksaan', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                                ->join('users', 'users.id', '=', 'balita.id_users')
                                ->groupBy('balita.id_balita')
                                ->get(),
                
        ];

        return view('admin/laporanpemeriksaan')->with('data', $data);
    }

    
    public function filter(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;
        $button = $request->button;


        if ($button ==  'filter') {
            $data = [
                'title' => "Data Pemeriksaan",
                'data_pemeriksaan' => Balita::selectRaw('*')
                                    ->Join('pemeriksaan', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                                    ->join('users', 'users.id', '=', 'balita.id_users')
                                    ->whereBetween('tanggal_pemeriksaan', [$dari_tanggal, $sampai_tanggal])
                                    ->groupBy('balita.id_balita')
                                    ->get(),
                    
            ];
    
            return view('admin/laporanpemeriksaan')->with('data', $data);
        } else {
            $data = [
                'title' => "Data Pemeriksaan",
                'data_pemeriksaan' => Balita::selectRaw('*')
                                    ->Join('pemeriksaan', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                                    ->join('users', 'users.id', '=', 'balita.id_users')
                                    ->whereBetween('tanggal_pemeriksaan', [$dari_tanggal, $sampai_tanggal])
                                    ->groupBy('balita.id_balita')
                                    ->get(),
                    
            ];
    
            return view('admin/cetaklaporanpemeriksaan')->with('data', $data);
        }
        
        
    }



}
