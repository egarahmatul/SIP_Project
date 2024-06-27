<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

use App\Models\Berita;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataEventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Event",
            'event' => Event::get(),
        ];
    

        return view('users/event')->with('data', $data);
    }

    public function detail($id_event)
    {
        $data = [
            'title' => "Data Event",
            'detail' => Event::where('id_event', $id_event)->first(),
        ];
    

        return view('users/detail_event')->with('data', $data);
    }
    

    


}
