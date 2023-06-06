<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    
    public function index()
    {
        return view('dashboards.admins.index');
    }

    public function profile()
    {
        return view('dashboards.admins.profile');
    }

    public function settings()
    {
        return view('dashboards.admins.settings');
    }
}
