<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    const VIEW = "dashboard";

    public function index()
    {
        return view(self::VIEW . ".index");
    }
}
