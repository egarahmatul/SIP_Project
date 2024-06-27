<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jadwal;

use App\Models\Informasi;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Jadwal",
            'jadwal' => Jadwal::get(),
        ];
    

        return view('users/jadwal')->with('data', $data);
    }

}
