<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Models\Fines;
use App\Models\Merchant;
use App\Models\Seizures;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $merchants_count = Merchant::all();
        $causes_count = Cause::all();
        $seizures_count = Seizures::all();
        $fines_count=Fines::all();
        return view('dashboard.home', compact('merchants_count', 'causes_count', 'fines_count','seizures_count'));
    }
}
