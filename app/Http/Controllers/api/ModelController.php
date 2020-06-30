<?php

namespace App\Http\Controllers\api;

use App\helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\CarModel;

class ModelController extends Controller
{
    public function index($make_id)
    {
        $models = CarModel::selectRaw("Model_ID, Model_Name")->where("Make_ID", $make_id)->get();
        return ResponseHelper::success($models);
    }
}
