<?php

namespace App\Http\Controllers\api;

use App\helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Make;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    public function index()
    {
        $make = Make::selectRaw("Make_ID, Make_Name")->where("status", 1)->orderBy("Make_Name", "ASC")->get();
        return ResponseHelper::success($make);
    }
}
