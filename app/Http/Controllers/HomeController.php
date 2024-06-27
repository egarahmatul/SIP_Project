<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Balita;
use App\Models\Pemeriksaan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => "Halaman Orang Tua",
            'jadwal' => Jadwal::get(),
            'jumlah_bidan' => User::where('hak_akses', 'bidan')->get()->count(),
            'jumlah_balita' => Balita::get()->count(),
            'jumlah_pemeriksaan' => Pemeriksaan::get()->count(),
            'jumlah_jadwal' => Jadwal::get()->count(),
        ];

        return view('users/index')->with('data', $data);
    }
}
