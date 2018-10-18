<?php

namespace App\Http\Controllers\Admin\Sidebars;

use App\Models\Sidebars;
use App\Models\Banner;
use App\Models\ModulesToPage;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use Illuminate\Routing\Router;

class SidebarController extends AdminController
{

    private $navigationType = 'main';

    private $defaultParent = 0;

    private $orderProperty = 'header_order';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Sidebars::all();
      save_resource_url();
      return $this->view('sidebars.sidebars')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $moduls = ModulesToPage::getAllList();
        return $this->view('sidebars.create_edit', compact('moduls'));
    }

    /**
     * Store a newly created page in storage.
     *
     * @return Response
     */
    public function store()
    {
      $attributes = request()->validate(Sidebars::$rules, Sidebars::$messages);
      $attributes['sidebar_name'] = input('sidebar_name');
      $attributes['sidebar_type'] = input('sidebar_type');
      $sidebar = $this->createEntry(Sidebars::class, $attributes);
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
        $parent = null;
        $item = Sidebars::find($id);
        $moduls = $item->sidebars()->get();

        $html = '<ol class="dd-list">';

        $parentId = ($parent ? $parent->id : 0);
        $items = $moduls;

        foreach ($items as $key => $nav) {
            $html .= '<li class="dd-item" data-id="' . $nav->id . '" >';
            $html .= '<div class="box box-primary box-solid dd-handle">
              <div class="box-header with-border">'.$nav->name . ' ' . ($nav->is_hidden == 1 ? '(HIDDEN)' : '') . ' <span style="float:right"> ' . $nav->url . ' </span>'.'</div>
              <div class="box-body">'.$nav->content . '</div>

              <div class="box-footer dd-nodrag">
              <button type="button" class="btn btn-labeled btn-default text-primary buttonEdit" data-action="edit" data-id="'.$nav->id.'">
                  <span class="btn-label"><i class="fa fa-fw fa-plus-circle"></i></span>Edit
              </button>
              </div>
              <p>'.$nav->parent_id.'</p>
            </div>';
            $html .= '</li>';
        }

        $html .= '</ol>';
        $itemsHtml = (count($items) >= 1 ? $html : '');
        return $this->view('sidebars.create_edit', compact('moduls', 'item', 'itemsHtml'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $item = Sidebars::find($id);
      $attributes = request()->validate(Sidebars::$rules, Sidebars::$messages);
      $attributes['sidebar_name'] = $request['sidebar_name'];
      $attributes['sidebar_type'] = $request['sidebar_type'];
      $item = $this->updateEntry($item, $attributes);
      return redirect_to_resource();
    }



    /**
     * @param ModulesToPage $modulesToPage
     * @return array
     */
    public function updateOrder(ModulesToPage $modulesToPage)
    {
        $items = json_decode(request('list'), true);
        foreach ($items as $key => $item) {
          $end[] = array($key => $item['id']);
        }
        foreach ($end as $key => $value) {
          ModulesToPage::where('id', $value)->update(['parent_id'=> $key]);
        }
        return ['result' => 'success'];
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Sidebars::find($id);
      $this->deleteEntry($item, request());
      return redirect_to_resource();
    }
}
