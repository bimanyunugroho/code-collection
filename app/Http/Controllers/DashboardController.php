<?php

namespace App\Http\Controllers;

use App\Models\Codex;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_users'   => $this->totalUsers(),
            'total_masters' => $this->totalMasterData(),
            'total_koleksi' => $this->totalKoleksiKoding(),
        ];

        return view('dashboard.dashboard', $data);
    }

    public function totalUsers()
    {
        if (Auth::check())
        {
            return User::count();
        } else {
            return 0;
        }
    }

    public function totalMasterData()
    {
        if (Auth::check())
        {
            return Type::count();
        } else {
            return 0;
        }
    }

    public function totalKoleksiKoding()
    {
        if (Auth::check())
        {
            return Codex::count();
        } else {
            return 0;
        }
    }
}
