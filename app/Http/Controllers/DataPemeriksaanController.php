<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemeriksaan;
use App\Models\Balita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataPemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => "Data Pemeriksaan",
            'data_pemeriksaan' => Balita::selectRaw('*,COUNT(pemeriksaan.id_pemeriksaan) as jumlah_pemeriksaan')
                                ->leftJoin('pemeriksaan', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                                ->join('users', 'users.id', '=', 'balita.id_users')
                                ->groupBy('balita.id_balita')
                                ->get(),
        ];

        return view('admin/pemeriksaan/index')->with('data', $data);
    }

    public function detail($id_balita)
    {
        $data_pemeriksaan = Pemeriksaan::join('balita', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
        ->join('users', 'users.id', '=', 'pemeriksaan.created_by')
        ->where('balita.id_balita', $id_balita)
        ->get();

        $tanggal_pemeriksaan = [];
        $tinggi_badan = [];
        $berat_badan = [];
        $lingkar_kepala = [];
        $status_gizi = [];
        $status_tinggi = [];

        foreach ($data_pemeriksaan as $key => $value) {
            $umur[] = $value->umur;
            $tinggi_badan[] = $value->tinggi_badan;
            $berat_badan[] = $value->berat_badan;
            $lingkar_kepala[] = $value->lingkar_kepala;
            // Hitung status gizi/berat
            $status_gizi[] = $this->calculateStatusGizi($value->umur, $value->berat_badan);
            // Hitung status tinggi
            $status_tinggi[] = $this->calculateStatusTinggi($value->umur, $value->tinggi_badan);
        }

        $chart = [
            'tanggal_pemeriksaan' => $umur,
            'tinggi_badan' => $tinggi_badan,
            'berat_badan' => $berat_badan,
            'lingkar_kepala' => $lingkar_kepala,
            'status_gizi' => $status_gizi,
            'status_tinggi' => $status_tinggi
        ];

        $data = [
            'title' => "Data Pemeriksaan",
            'data_balita' => Balita::join('users', 'users.id', '=', 'balita.id_users')->where('balita.id_balita', $id_balita)->first(),
            'balita' => Balita::get(),
            'chart' => $chart,
            'data_pemeriksaan' => Pemeriksaan::join('balita', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                                ->join('users', 'users.id', '=', 'pemeriksaan.created_by')
                                ->where('balita.id_balita', $id_balita)
                                ->get(),
        ];

        return view('admin/pemeriksaan/detail')->with('data', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah Data Pemeriksaan",
            'data_balita' => Balita::get(),
        ];

        return view('admin/pemeriksaan/create')->with('data', $data);
    }


    //status berat badan
    private function calculateStatusGizi($umur, $berat_badan)
    {
        $status_gizi = 'Tidak Normal';
       
        if ($umur == 1) {
            if ($berat_badan >= 2.7 && $berat_badan <= 3.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 3.6 && $berat_badan <= 4.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 5.5 && $berat_badan <= 6.2) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 2) {
            if ($berat_badan >= 3.4 && $berat_badan <= 3.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 4.5 && $berat_badan <= 5.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 6.6 && $berat_badan <= 7.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 3) {
            if ($berat_badan >= 4.0 && $berat_badan <= 4.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 5.2 && $berat_badan <= 6.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 7.5 && $berat_badan <= 8.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 4) {
            if ($berat_badan >= 4.4 && $berat_badan <= 5.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 5.7 && $berat_badan <= 7.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 8.2 && $berat_badan <= 9.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 5) {
            if ($berat_badan >= 4.8 && $berat_badan <= 5.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 6.1 && $berat_badan <= 7.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 8.8 && $berat_badan <= 10.0) {
                $status_gizi = 'Gizi Buruk';
        }   elseif ($umur == 6) {
            if ($berat_badan >= 5.1 && $berat_badan <= 5.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 6.5 && $berat_badan <= 8.2) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 9.3 && $berat_badan <= 10.6) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 7) {
            if ($berat_badan >= 5.3 && $berat_badan <= 6.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 6.8 && $berat_badan <= 8.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 9.8 && $berat_badan <= 11.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 8) {
            if ($berat_badan >= 5.6 && $berat_badan <= 6.3) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 7.0 && $berat_badan <= 9.0) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 10.2 && $berat_badan <= 11.6) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 9) {
            if ($berat_badan >= 5.8 && $berat_badan <= 6.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 7.3 && $berat_badan <= 9.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 10.5 && $berat_badan <= 12.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 10) {
            if ($berat_badan >= 5.9 && $berat_badan <= 6.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 7.5 && $berat_badan <= 9.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 10.9 && $berat_badan <= 12.4) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 11) {
            if ($berat_badan >= 6.1 && $berat_badan <= 6.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 7.7 && $berat_badan <= 9.9) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 11.2 && $berat_badan <= 12.8) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 12) {
            if ($berat_badan >= 6.3 && $berat_badan <= 7.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 7.9 && $berat_badan <= 10.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 11.5 && $berat_badan <= 13.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 13) {
            if ($berat_badan >= 6.4 && $berat_badan <= 7.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 8.1 && $berat_badan <= 10.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 11.8 && $berat_badan <= 13.5) {
                $status_gizi = 'Gizi Buruk';
            }
        }  elseif ($umur == 14) {
            if ($berat_badan >= 6.6 && $berat_badan <= 7.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 8.3 && $berat_badan <= 10.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 12.1 && $berat_badan <= 13.8) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 15) {
            if ($berat_badan >= 6.7 && $berat_badan <= 7.6) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 8.5 && $berat_badan <= 10.9) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 12.4 && $berat_badan <= 14.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 16) {
            if ($berat_badan >= 6.9 && $berat_badan <= 7.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 8.7 && $berat_badan <= 11.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 12.6 && $berat_badan <= 14.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 17) {
            if ($berat_badan >= 7.0 && $berat_badan <= 7.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 8.9 && $berat_badan <= 11.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 12.9 && $berat_badan <= 14.8) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 18) {
            if ($berat_badan >= 7.2 && $berat_badan <= 8.1) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 9.1 && $berat_badan <= 11.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 13.2 && $berat_badan <= 15.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 19) {
            if ($berat_badan >= 7.3 && $berat_badan <= 8.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 9.2 && $berat_badan <= 11.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 13.5 && $berat_badan <= 15.4) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 20) {
            if ($berat_badan >= 7.5 && $berat_badan <= 8.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 9.4 && $berat_badan <= 12.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 13.7 && $berat_badan <= 15.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 21) {
            if ($berat_badan >= 7.6 && $berat_badan <= 8.6) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 9.6 && $berat_badan <= 12.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 14.0 && $berat_badan <= 16.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 22) {
            if ($berat_badan >= 7.8 && $berat_badan <= 8.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 9.8 && $berat_badan <= 12.5) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 14.3 && $berat_badan <= 16.4) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 23) {
            if ($berat_badan >= 7.9 && $berat_badan <= 8.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.0 && $berat_badan <= 12.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 14.6 && $berat_badan <= 16.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 24) {
            if ($berat_badan >= 8.1 && $berat_badan <= 9.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.2 && $berat_badan <= 13.0) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 14.8 && $berat_badan <= 17.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 25) {
            if ($berat_badan >= 8.2 && $berat_badan <= 9.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.3 && $berat_badan <= 13.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 15.1 && $berat_badan <= 17.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 26) {
            if ($berat_badan >= 8.4 && $berat_badan <= 9.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.5 && $berat_badan <= 13.5) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 15.4 && $berat_badan <= 17.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 27) {
            if ($berat_badan >= 8.5 && $berat_badan <= 9.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.7 && $berat_badan <= 13.7) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 15.7 && $berat_badan <= 18.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 28) {
            if ($berat_badan >= 8.6 && $berat_badan <= 9.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 10.9 && $berat_badan <= 14.0) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 16.0 && $berat_badan <= 18.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 29) {
            if ($berat_badan >= 8.8 && $berat_badan <= 9.8) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.1 && $berat_badan <= 14.2) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 16.2 && $berat_badan <= 18.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 30) {
            if ($berat_badan >= 8.9 && $berat_badan <= 10.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.2 && $berat_badan <= 14.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 16.5 && $berat_badan <= 19.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 31) {
            if ($berat_badan >= 9.0 && $berat_badan <= 10.1) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.4 && $berat_badan <= 14.7) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 16.8 && $berat_badan <= 19.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 32) {
            if ($berat_badan >= 9.1 && $berat_badan <= 10.3) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.6 && $berat_badan <= 14.9) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 17.1 && $berat_badan <= 19.6) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 33) {
            if ($berat_badan >= 9.3 && $berat_badan <= 10.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.7 && $berat_badan <= 15.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 17.3 && $berat_badan <= 20.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 34) {
            if ($berat_badan >= 9.4 && $berat_badan <= 10.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 11.9 && $berat_badan <= 15.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 17.6 && $berat_badan <= 20.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 35) {
            if ($berat_badan >= 9.5 && $berat_badan <= 10.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.0 && $berat_badan <= 15.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 17.9 && $berat_badan <= 20.6) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 36) {
            if ($berat_badan >= 9.6 && $berat_badan <= 10.8) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.2 && $berat_badan <= 15.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 18.1 && $berat_badan <= 20.9) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 37) {
            if ($berat_badan >= 9.7 && $berat_badan <= 10.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.4 && $berat_badan <= 16.0) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 18.4 && $berat_badan <= 21.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 38) {
            if ($berat_badan >= 9.8 && $berat_badan <= 11.1) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.5 && $berat_badan <= 16.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 18.7 && $berat_badan <= 21.6) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 39) {
            if ($berat_badan >= 9.9 && $berat_badan <= 11.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.7 && $berat_badan <= 16.5) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 19.0 && $berat_badan <= 22.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 40) {
            if ($berat_badan >= 10.1 && $berat_badan <= 11.3) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 12.8 && $berat_badan <= 16.7) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 19.2 && $berat_badan <= 22.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 41) {
            if ($berat_badan >= 10.2 && $berat_badan <= 11.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.0 && $berat_badan <= 16.9) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 19.5 && $berat_badan <= 22.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 42) {
            if ($berat_badan >= 10.3 && $berat_badan <= 11.6) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.1 && $berat_badan <= 17.2) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 19.8 && $berat_badan <= 23.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 43) {
            if ($berat_badan >= 10.4 && $berat_badan <= 11.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.3 && $berat_badan <= 17.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 20.1 && $berat_badan <= 23.4) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 44) {
            if ($berat_badan >= 10.5 && $berat_badan <= 11.8) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.4 && $berat_badan <= 17.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 20.4 && $berat_badan <= 23.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 45) {
            if ($berat_badan >= 10.6 && $berat_badan <= 12.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.6 && $berat_badan <= 17.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 20.7 && $berat_badan <= 24.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 46) {
            if ($berat_badan >= 10.7 && $berat_badan <= 12.1) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.7 && $berat_badan <= 18.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 20.9 && $berat_badan <= 24.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 47) {
            if ($berat_badan >= 10.8 && $berat_badan <= 12.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 13.9 && $berat_badan <= 18.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 21.2 && $berat_badan <= 24.8) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 48) {
            if ($berat_badan >= 10.9 && $berat_badan <= 12.3) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.0 && $berat_badan <= 18.5) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 21.5 && $berat_badan <= 25.2) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 49) {
            if ($berat_badan >= 11.0 && $berat_badan <= 12.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.2 && $berat_badan <= 18.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 21.8 && $berat_badan <= 25.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 50) {
            if ($berat_badan >= 11.1 && $berat_badan <= 12.6) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.3 && $berat_badan <= 19.00) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 22.1 && $berat_badan <= 25.9) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 51) {
            if ($berat_badan >= 11.2 && $berat_badan <= 12.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.5 && $berat_badan <= 19.2) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 22.4 && $berat_badan <= 26.3) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 52) {
            if ($berat_badan >= 11.3 && $berat_badan <= 12.8) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.6 && $berat_badan <= 19.4) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 22.6 && $berat_badan <= 26.6) {
                $status_gizi = 'Gizi Buruk';
            }
        }   elseif ($umur == 53) {
            if ($berat_badan >= 11.4 && $berat_badan <= 12.9) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.8 && $berat_badan <= 19.7) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 22.9 && $berat_badan <= 27.0) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 54) {
            if ($berat_badan >= 11.5 && $berat_badan <= 13.0) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 14.9 && $berat_badan <= 19.9) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 23.2 && $berat_badan <= 27.4) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 55) {
            if ($berat_badan >= 11.6 && $berat_badan <= 13.2) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.1 && $berat_badan <= 20.1) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 23.5 && $berat_badan <= 27.7) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 56) {
            if ($berat_badan >= 11.7 && $berat_badan <= 13.3) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.2 && $berat_badan <= 20.3) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 23.8 && $berat_badan <= 28.1) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 57) {
            if ($berat_badan >= 11.8 && $berat_badan <= 13.4) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.3 && $berat_badan <= 20.6) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 24.1 && $berat_badan <= 28.5) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 58) {
            if ($berat_badan >= 11.9 && $berat_badan <= 13.5) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.5 && $berat_badan <= 20.8) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 24.4 && $berat_badan <= 28.8) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 59) {
            if ($berat_badan >= 12.0 && $berat_badan <= 13.6) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.6 && $berat_badan <= 21.0) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 24.6 && $berat_badan <= 29.2) {
                $status_gizi = 'Gizi Buruk';
            }
        } elseif ($umur == 60) {
            if ($berat_badan >= 12.1 && $berat_badan <= 13.7) {
                $status_gizi = 'Gizi Kurang';
            } elseif ($berat_badan >= 15.8 && $berat_badan <= 21.2) {
                $status_gizi = 'Gizi Normal';
            } elseif ($berat_badan >= 24.9 && $berat_badan <= 29.5) {
                $status_gizi = 'Gizi Buruk';
            }
        }  }
        return $status_gizi;
       }

       //status tinggi badan
       private function calculateStatusTinggi($umur, $tinggi_badan)
       {
           $status_tinggi = 'Tidak Normal';
          
           if ($umur == 1) {
               if ($tinggi_badan >= 48.9 && $tinggi_badan <= 50.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 50.9 && $tinggi_badan <= 56.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 56.8 && $tinggi_badan <= 60.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 2) {
               if ($tinggi_badan >= 51.0 && $tinggi_badan <= 54.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 54.5 && $tinggi_badan <= 60.4) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 60.5 && $tinggi_badan <= 64.4) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 3) {
               if ($tinggi_badan >= 54.5 && $tinggi_badan <= 57.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 57.4 && $tinggi_badan <= 63.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 63.6 && $tinggi_badan <= 67.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 4) {
               if ($tinggi_badan >= 57.5 && $tinggi_badan <= 59.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 59.8 && $tinggi_badan <= 66.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 66.1 && $tinggi_badan <= 70.1) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 5) {
               if ($tinggi_badan >= 59.8 && $tinggi_badan <= 61.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 61.8 && $tinggi_badan <= 68.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 68.1 && $tinggi_badan <= 72.2) {
                   $status_tinggi = 'Gizi Buruk';
           }   elseif ($umur == 6) {
               if ($tinggi_badan >= 61.9 && $tinggi_badan <= 63.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 63.4 && $tinggi_badan <= 69.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 69.9 && $tinggi_badan <= 74.0) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 7) {
               if ($tinggi_badan >= 63.4 && $tinggi_badan <= 64.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 64.9 && $tinggi_badan <= 71.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 71.4 && $tinggi_badan <= 75.7) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 8) {
               if ($tinggi_badan >= 65.0 && $tinggi_badan <= 66.2) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 66.3 && $tinggi_badan <= 72.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 72.9 && $tinggi_badan <= 75.7) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 9) {
               if ($tinggi_badan >= 66.3 && $tinggi_badan <= 67.5) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 67.6 && $tinggi_badan <= 74.2) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 74.3 && $tinggi_badan <= 78.7) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 10) {
               if ($tinggi_badan >= 67.7 && $tinggi_badan <= 68.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 68.8 && $tinggi_badan <= 75.6) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 75.7 && $tinggi_badan <= 80.1) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 11) {
               if ($tinggi_badan >= 68.8 && $tinggi_badan <= 69.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 70.0 && $tinggi_badan <= 76.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 77.0 && $tinggi_badan <= 81.5) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 12) {
               if ($tinggi_badan >= 70.1 && $tinggi_badan <= 71.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 71.1 && $tinggi_badan <= 78.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 78.2 && $tinggi_badan <= 82.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 13) {
               if ($tinggi_badan >= 71.2 && $tinggi_badan <= 72.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 72.2 && $tinggi_badan <= 79.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 79.4 && $tinggi_badan <= 84.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           }  elseif ($umur == 14) {
               if ($tinggi_badan >= 72.3 && $tinggi_badan <= 73.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 73.2 && $tinggi_badan <= 80.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 80.6 && $tinggi_badan <= 85.5) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 15) {
               if ($tinggi_badan >= 73.3 && $tinggi_badan <= 74.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 74.2 && $tinggi_badan <= 81.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 81.2 && $tinggi_badan <= 86.7) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 16) {
               if ($tinggi_badan >= 74.3 && $tinggi_badan <= 75.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 75.1 && $tinggi_badan <= 82.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 82.9 && $tinggi_badan <= 88.0) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 17) {
               if ($tinggi_badan >= 75.2 && $tinggi_badan <= 76.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 76.1 && $tinggi_badan <= 83.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 84.0 && $tinggi_badan <= 89.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 18) {
               if ($tinggi_badan >= 76.2 && $tinggi_badan <= 76.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 77.0 && $tinggi_badan <= 85.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 85.1 && $tinggi_badan <= 90.4) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 19) {
               if ($tinggi_badan >= 77.1 && $tinggi_badan <= 77.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 77.8 && $tinggi_badan <= 86.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 86.1 && $tinggi_badan <= 91.5) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 20) {
               if ($tinggi_badan >= 77.9 && $tinggi_badan <= 78.6) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 78.9 && $tinggi_badan <= 87.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 87.1 && $tinggi_badan <= 92.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 21) {
               if ($tinggi_badan >= 77.0 && $tinggi_badan <= 79.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 79.5 && $tinggi_badan <= 88.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 88.1 && $tinggi_badan <= 93.8) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 22) {
               if ($tinggi_badan >= 79.6 && $tinggi_badan <= 80.2) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 80.3 && $tinggi_badan <= 89.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 89.1 && $tinggi_badan <= 94.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 23) {
               if ($tinggi_badan >= 80.4 && $tinggi_badan <= 81.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 81.1 && $tinggi_badan <= 89.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 90.0 && $tinggi_badan <= 95.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 24) {
               if ($tinggi_badan >= 78.0 && $tinggi_badan <= 81.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 81.1 && $tinggi_badan <= 90.2) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 90.3 && $tinggi_badan <= 96.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 25) {
               if ($tinggi_badan >= 78.6 && $tinggi_badan <= 81.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 81.8 && $tinggi_badan <= 91.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 91.2 && $tinggi_badan <= 97.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 26) {
               if ($tinggi_badan >= 79.3 && $tinggi_badan <= 82.5) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 82.6 && $tinggi_badan <= 92.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 92.1 && $tinggi_badan <= 98.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 27) {
               if ($tinggi_badan >= 79.9 && $tinggi_badan <= 83.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 83.2 && $tinggi_badan <= 92.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 93.0 && $tinggi_badan <= 99.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 28) {
               if ($tinggi_badan >= 80.5 && $tinggi_badan <= 83.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 83.9 && $tinggi_badan <= 93.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 93.8 && $tinggi_badan <= 100.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 29) {
               if ($tinggi_badan >= 81.1 && $tinggi_badan <= 84.5) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 84.6 && $tinggi_badan <= 94.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 94.6 && $tinggi_badan <= 101.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 30) {
               if ($tinggi_badan >= 81.7 && $tinggi_badan <= 85.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 85.2 && $tinggi_badan <= 95.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 95.4 && $tinggi_badan <= 102.1) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 31) {
               if ($tinggi_badan >= 82.3 && $tinggi_badan <= 85.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 85.8 && $tinggi_badan <= 96.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 96.2 && $tinggi_badan <= 103.0) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 32) {
               if ($tinggi_badan >= 82.8 && $tinggi_badan <= 86.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 86.5 && $tinggi_badan <= 96.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 97.0 && $tinggi_badan <= 103.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 33) {
               if ($tinggi_badan >= 83.4 && $tinggi_badan <= 86.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 87.0 && $tinggi_badan <= 97.6) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 97.7 && $tinggi_badan <= 104.8) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 34) {
               if ($tinggi_badan >= 83.9 && $tinggi_badan <= 87.5) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 87.6 && $tinggi_badan <= 98.4) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 98.5 && $tinggi_badan <= 105.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 35) {
               if ($tinggi_badan >= 84.4 && $tinggi_badan <= 88.1) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 88.2 && $tinggi_badan <= 98.4) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 98.5 && $tinggi_badan <= 106.4) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 36) {
               if ($tinggi_badan >= 85.0 && $tinggi_badan <= 88.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 88.8 && $tinggi_badan <= 99.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 99.9 && $tinggi_badan <= 107.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 37) {
               if ($tinggi_badan >= 85.5 && $tinggi_badan <= 89.2) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 89.3 && $tinggi_badan <= 100.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 100.6 && $tinggi_badan <= 108.0) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 38) {
               if ($tinggi_badan >= 86.0 && $tinggi_badan <= 89.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 89.9 && $tinggi_badan <= 101.2) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 101.3 && $tinggi_badan <= 108.8) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 39) {
               if ($tinggi_badan >= 86.5 && $tinggi_badan <= 90.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 90.4 && $tinggi_badan <= 101.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 101.9 && $tinggi_badan <= 109.5) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 40) {
               if ($tinggi_badan >= 87.0 && $tinggi_badan <= 90.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 91.0 && $tinggi_badan <= 102.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 102.6 && $tinggi_badan <= 110.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 41) {
               if ($tinggi_badan >= 87.5 && $tinggi_badan <= 91.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 91.5 && $tinggi_badan <= 103.2) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 103.3 && $tinggi_badan <= 111.0) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 42) {
               if ($tinggi_badan >= 88.0 && $tinggi_badan <= 91.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 92.0 && $tinggi_badan <= 103.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 103.9 && $tinggi_badan <= 111.7) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 43) {
               if ($tinggi_badan >= 88.4 && $tinggi_badan <= 92.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 92.5 && $tinggi_badan <= 104.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 104.6 && $tinggi_badan <= 112.5) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 44) {
               if ($tinggi_badan >= 88.9 && $tinggi_badan <= 93.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 93.1 && $tinggi_badan <= 105.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 105.2 && $tinggi_badan <= 113.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 45) {
               if ($tinggi_badan >= 89.4 && $tinggi_badan <= 93.5) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 93.6 && $tinggi_badan <= 105.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 105.8 && $tinggi_badan <= 113.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 46) {
               if ($tinggi_badan >= 89.8 && $tinggi_badan <= 94.0) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 94.1 && $tinggi_badan <= 106.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 106.4 && $tinggi_badan <= 114.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 47) {
               if ($tinggi_badan >= 90.3 && $tinggi_badan <= 94.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 94.5 && $tinggi_badan <= 106.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 107.0 && $tinggi_badan <= 115.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 48) {
               if ($tinggi_badan >= 90.7 && $tinggi_badan <= 94.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 95.0 && $tinggi_badan <= 107.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 107.6 && $tinggi_badan <= 115.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 49) {
               if ($tinggi_badan >= 91.2 && $tinggi_badan <= 95.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 95.5 && $tinggi_badan <= 108.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 108.2 && $tinggi_badan <= 116.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 50) {
               if ($tinggi_badan >= 91.6 && $tinggi_badan <= 95.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 96.0 && $tinggi_badan <= 108.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 108.8 && $tinggi_badan <= 117.3) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 51) {
               if ($tinggi_badan >= 92.1 && $tinggi_badan <= 96.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 96.5 && $tinggi_badan <= 109.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 109.4 && $tinggi_badan <= 117.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 52) {
               if ($tinggi_badan >= 92.5 && $tinggi_badan <= 96.9) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 97.0 && $tinggi_badan <= 109.9) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 110.0 && $tinggi_badan <= 118.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           }   elseif ($umur == 53) {
               if ($tinggi_badan >= 93.0 && $tinggi_badan <= 97.4) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 97.5 && $tinggi_badan <= 110.5) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 110.6 && $tinggi_badan <= 119.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 54) {
               if ($tinggi_badan >= 93.4 && $tinggi_badan <= 97.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 97.9 && $tinggi_badan <= 111.1) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 111.2 && $tinggi_badan <= 119.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 55) {
               if ($tinggi_badan >= 93.9 && $tinggi_badan <= 98.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 98.4 && $tinggi_badan <= 111.7) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 111.8 && $tinggi_badan <= 120.6) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 56) {
               if ($tinggi_badan >= 94.3 && $tinggi_badan <= 98.8) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 98.9 && $tinggi_badan <= 112.3) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 112.4 && $tinggi_badan <= 121.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 57) {
               if ($tinggi_badan >= 94.7 && $tinggi_badan <= 99.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 99.4 && $tinggi_badan <= 112.8) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 112.9 && $tinggi_badan <= 121.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 58) {
               if ($tinggi_badan >= 95.2 && $tinggi_badan <= 99.7) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 99.8 && $tinggi_badan <= 113.4) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 113.5 && $tinggi_badan <= 121.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 59) {
               if ($tinggi_badan >= 95.6 && $tinggi_badan <= 100.2) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 100.3 && $tinggi_badan <= 114.0) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 114.1 && $tinggi_badan <= 123.2) {
                   $status_tinggi = 'Gizi Buruk';
               }
           } elseif ($umur == 60) {
               if ($tinggi_badan >= 96.1 && $tinggi_badan <= 105.3) {
                   $status_tinggi = 'Gizi Kurang';
               } elseif ($tinggi_badan >= 105.4 && $tinggi_badan <= 114.6) {
                   $status_tinggi = 'Gizi Normal';
               } elseif ($tinggi_badan >= 114.7 && $tinggi_badan <= 123.9) {
                   $status_tinggi = 'Gizi Buruk';
               }
           }  }
           return $status_tinggi;
          }

    public function insert(Request $request)
    {
        $umur = $request->umur;
        $berat_badan = $request->berat_badan;
        $tinggi_badan = $request->tinggi_badan;
        $status_gizi = $this->calculateStatusGizi($umur, $berat_badan);
        $status_tinggi = $this->calculateStatusTinggi($umur, $tinggi_badan);

        $data = [
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'cara_ukur' => $request->cara_ukur,
            'umur' => $umur,
            'imunisasi' => $request->imunisasi,
            'vitamin' => $request->vitamin,
            'obat_cacing' => $request->obat_cacing,
            'status_gizi' => $status_gizi,
            'status_tinggi' => $status_tinggi,
            'saran' => $request->saran,
            'id_balita' => $request->id_balita,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];

        Pemeriksaan::insert($data);
        return redirect('data-pemeriksaan')->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $id_pemeriksaan = $request->id_pemeriksaan;
        $id_balita = $request->id_balita;
        $umur = $request->umur;
        $berat_badan = $request->berat_badan;
        $status_gizi = $this->calculateStatusGizi($umur, $berat_badan);

        $tinggi_badan = $request->tinggi_badan;
        $status_tinggi = $this->calculateStatusTinggi($umur, $tinggi_badan);

        $data = [
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'lingkar_kepala' => $request->lingkar_kepala,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'cara_ukur' => $request->cara_ukur,
            'umur' => $umur,
            'imunisasi' => $request->imunisasi,
            'vitamin' => $request->vitamin,
            'obat_cacing' => $request->obat_cacing,
            'status_gizi' => $status_gizi,
            'status_tinggi' => $status_tinggi,
            'saran' => $request->saran,
            'updated_by' => Auth::user()->id,
        ];

        Pemeriksaan::where('id_pemeriksaan', $id_pemeriksaan)->update($data);
        return redirect('detail-pemeriksaan/' . $id_balita)->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id_pemeriksaan)
    {
        Pemeriksaan::where('id_pemeriksaan', $id_pemeriksaan)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }
}
