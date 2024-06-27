<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Balita;
use App\Models\Pemeriksaan;

use App\Models\Informasi;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerkembanganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id_users = Auth::user()->id;

        $data_pemeriksaan = Pemeriksaan::join('balita', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
        ->join('users', 'users.id', '=', 'pemeriksaan.created_by')
        ->where('balita.id_users', $id_users)
        ->get();


        $tanggal_pemeriksaan= [];
        $tinggi_badan= [];
        $berat_badan= [];
        $lingkar_kepala= [];
        $status_gizi= [];

        
        foreach ($data_pemeriksaan as $key => $value) {
            $umur[] = $value->umur;
            $tinggi_badan[] = $value->tinggi_badan;
            $berat_badan[] = $value->berat_badan;
            $lingkar_kepala[] = $value->lingkar_kepala;
            // Hitung status gizi
            $status_gizi[] = $this->calculateStatusGizi($value->umur, $value->berat_badan);
        }

        $chart = [
            'tanggal_pemeriksaan' => $umur,
            'tinggi_badan' => $tinggi_badan,
            'berat_badan' => $berat_badan,
            'lingkar_kepala' => $lingkar_kepala,
            'status_gizi' => $status_gizi
        ];

        $data = [
            'title' => "Data Perkembangan",
            'chart' => $chart,
            'data_balita' => Balita::join('users', 'users.id', '=', 'balita.id_users')->where('users.id', $id_users)->first(),
            'data_pemeriksaan' => Pemeriksaan::join('balita', 'balita.id_balita', '=', 'pemeriksaan.id_balita')
                            ->join('users', 'users.id', '=', 'pemeriksaan.created_by')
                            ->where('balita.id_users', $id_users)
                            ->get(),
        ];
    

        return view('users/perkembangan')->with('data', $data);
    }

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
        } }
        return $status_gizi;
       }
}
