<?php

namespace App\Http\Controllers\Admin\Sidebars;

use App\Models\Sidebars;
use App\Models\Banner;
use App\Models\ModulesToPage;
use App\Models\SidebarTypes;
use App\Models\Weather;
use App\Models\WeatherTypes;
use App\Models\City;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class WeatherController extends AdminController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $items = Weather::all();
        return $this->view('sidebars.weather', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::getAllLists();
        $weather_type = WeatherTypes::getAllLists();
        return $this->view('sidebars.create_edit_weather', compact('cities', 'weather_type'));
    }

    /**
     * Store a newly created page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $weather int
     * @return Response
     */
    public function store(Request  $request)
    {
      // /$attributes = request()->validate(Weather::$rules, Weather::$messages);
      $attributes['cities_id'] = $request['cities'];
      $attributes['weather_type'] = $request['weather_type'];
      $attributes['min-temp'] = $request['min-temp'];
      $attributes['max-temp'] = $request['max-temp'];
      $attributes['date'] = $request['date'];
      $weather = $this->createEntry(Weather::class, $attributes);
      return redirect_to_resource();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::getAllLists();
        $weather_type = WeatherTypes::find($id);
        return $this->view('sidebars.create_edit_weather', compact('cities', 'weather_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
