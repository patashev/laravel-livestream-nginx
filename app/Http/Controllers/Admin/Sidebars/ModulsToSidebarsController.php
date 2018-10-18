<?php

namespace App\Http\Controllers\Admin\Sidebars;

use App\Models\Sidebars;
use App\Models\Banner;
use App\Models\ModulesToPage;
use App\Models\SidebarTypes;
use App\Models\City;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ModulsToSidebarsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param $sidebar_id int
     * @return \Illuminate\Http\Response
     */
    public function index($sidebar_id)
    {
        return $this->view('sidebars.create_edit_sidebars', compact('sidebar_id'));
    }



    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        //$moduls = ModulesToPage::getAllList();
        return $this->view('sidebars.create_edit');
    }


    /**
     * Store a newly created page in storage.
     *
     * @param $sidebars_id int
     * @return Response
     */
    public function store($sidebars_id)
    {
      $attributes = request()->validate(ModulesToPage::$rules, ModulesToPage::$messages);
      $attributes['name'] = input('name');
      $attributes['content'] = input('content');
      $attributes['sidebars_id'] = $sidebars_id;
      $sidebar = $this->createEntry(ModulesToPage::class, $attributes);
      return redirect_to_resource();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $sidebar_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $sidebar_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $sidebar_id)
    {
      $item = ModulesToPage::find($sidebar_id);
      $type = SidebarTypes::getAllList();
      $cities = City::getAllLists();
      $test = $item->cities;
      return $this->view('sidebars.create_edit_sidebars', compact('sidebar_id', 'id', 'item', 'type', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $item = ModulesToPage::find($id);
      //$attributes = $request->validate(ModulesToPage::$rules, ModulesToPage::$messages);
      $attributes['name'] = $request['name'];
      $attributes['content'] = $request['content'];
      $attributes['parent_id'] = $item->parent_id;
      $attributes['sidebar_types_id'] = $request['type'];
      if ($request['type'] == 5) {
        $attributes['cities_id'] = $request['cities'];
      }
      $item = $this->updateEntry($item, $attributes);
      return redirect_to_resource();
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


    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
     public function cities()
     {
          return $this->hasMany('App\Models\City', 'cities_id', 'id');
     }
}
