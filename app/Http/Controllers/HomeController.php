<?php

namespace App\Http\Controllers;

use App\League;
use App\Pitch;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'teams_num' => Team::count(),
            'players_num' => User::where('type', 'player')->count(),
            'leagues_num' => League::count(),
            'pitches_num' => Pitch::count(),

            'leagues' => League::whereDate('date_from', '>=', Carbon::now()->format('Y-m-d'))->take(5)->orderby('date_from', 'ASC')->get(),
            'teams' => Team::take(5)->orderby('created_at', 'DESC')->get()
        ];
        return view(admin_vw() . '.home', $data);
    }
}
