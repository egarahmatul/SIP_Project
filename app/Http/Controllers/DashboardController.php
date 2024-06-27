<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Balita;
use App\Models\Jadwal;
use App\Models\Pemeriksaan;
class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
       
        $data = [
            'title' => "Dashboard ",
            'jumlah_bidan' => User::where('hak_akses', 'bidan')->get()->count(),
            'jumlah_balita' => Balita::get()->count(),
            'jumlah_pemeriksaan' => Pemeriksaan::get()->count(),
            'jumlah_jadwal' => Jadwal::get()->count(),
            'jumlah_gizi_baik' => Pemeriksaan::where('status_gizi', 'Gizi Baik')->get()->count(),
            'jumlah_gizi_kurang' => Pemeriksaan::where('status_gizi', 'Gizi Kurang')->get()->count(),
            'jumlah_gizi_buruk' => Pemeriksaan::where('status_gizi', 'Gizi Buruk')->get()->count(),
        ];

        return view('admin/dashboard')->with('data', $data);
        // if ( Auth::user()->hak_akses == 'admin') {
        // } 
            
            
        

    }
}
