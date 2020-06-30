<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarModelController extends Controller
{

    const VIEW = "models.";
    const TITLE = "Models";
    const ROUTE = "/models";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Make::with("models")->where("status", 1)->orderBy("Make_Name", "ASC")->get();
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::VIEW . "index", compact('data', 'title', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function edit($make_id)
    {
        $make = Make::where("Make_ID", $make_id)->with("models")->first();
        $modelIds = $make->models->pluck("Model_ID")->toArray() ?? [];
        $title = self::TITLE;
        $route = self::ROUTE;
        $models = $this->getModels($make_id);
        return view(self::VIEW . "create", compact('make', 'title', 'route', 'models', 'modelIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $models = $this->getModels($request->make_id);
        $arr = [];
        foreach ($models as $m) {
            if(in_array($m->Model_ID, $request->models)) {
                $pushing = (array) $m;
                if(isset($pushing["Make_Name"])) unset($pushing["Make_Name"]);
                $pushing["status"] = 1;
                $arr[] = $pushing;
            }
        }
        CarModel::where("Make_ID", $request->make_id)->delete();
        CarModel::insert($arr);

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $carModel)
    {
        //
    }

    public function getModels($make_id)
    {
        $response = Http::get("https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/$make_id?format=json");
        $decodedData = json_decode($response->body());
        return $decodedData->Results;
    }
}
