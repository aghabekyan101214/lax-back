<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MakeController extends Controller
{

    const VIEW = "makes.";
    const TITLE = "Makes";
    const ROUTE = "/makes";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Make::orderBy("status", "DESC")->orderBy("Id", "ASC")->paginate(500);
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
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::VIEW . "create", compact( 'title', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           "Make_Name" => "required|max:191"
        ]);

        $lastId = Make::orderBy("id", "DESC")->first();
        $make = new Make();
        $make->Make_Name = $request->Make_Name;
        $make->Make_ID = $lastId->id ?? 1;
        $make->status = 1;
        $make->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function show(Make $make)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function edit(Make $make)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::VIEW . "create", compact( 'title', 'route', 'make'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Make $make)
    {
        $this->validate($request, [
            "Make_Name" => "required|max:191"
        ]);

        $make->Make_Name = $request->Make_Name;
        $make->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function destroy(Make $make)
    {
        //
    }

    public static function getMakes()
    {
        $response = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json');
        $decodedData = json_decode($response->body());
        $arr = [];
        foreach ($decodedData->Results as $d) {
            $arr[] = (array) $d;
        }
        return Make::insert($arr);
    }

    public function changeStatus($id)
    {
        $make = Make::find($id);
        $make->status = $make->status == 0 ? 1 : 0;
        $make->save();

        return $make->status;
    }
}
