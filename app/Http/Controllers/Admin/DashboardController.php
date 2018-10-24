<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Market;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function show(Market $market)
    {
        return view('admin.show', compact('market'));
    }
}
