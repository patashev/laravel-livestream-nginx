<?php

namespace App\Http\Controllers\Admin\Images;

use Illuminate\Http\Request;
use App\Models\Images;
use App\Http\Controllers\Admin\AdminController;
use App\Models\NavigationAdmin;
use App\Models\ImageCategories;

class ImageController extends AdminController
{

    /**
     * Display a listing of videoRecord.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $categories = ImageCategories::getAllList();
        return $this->view('images.images.index')->with('categories', $categories);
    }



    /**
     * Show the video records for datatables.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function returnedRowedImages(Request $request)
    {
      save_resource_url();
      $draw = $request["draw"];
      $orderByColumnIndex  = $request['order'][0]['column'];
      switch (true) {
        case !empty($request['columns'][$orderByColumnIndex]['data']):
          $orderBy = (($request['columns'][$orderByColumnIndex]['data'] != 'action') ? $request['columns'][$orderByColumnIndex]['data'] : 'title');
          break;
        default:
          $orderBy = 'id';
          break;
      }
      $orderType = (!($request['order'][0]['dir']) ? 'asc' : $request['order'][0]['dir']);
      $start  = $request["start"];
      $length = $request['length'] ? $request['length'] : 10;
      $recordsTotal = Images::count();


      if(!empty($request['search']['value']) and $request['category'] == '' ){
        $items = Images::where('title', 'like', '%'.$request['search']['value'].'%')
          ->orWhere('description', 'like', '%'.$request['search']['value'].'%')
          ->orderBy($orderBy, $orderType)
          ->offset($start)
          ->limit($length)
          ->get();
        $recordsFiltered = Images::where('title', 'like', '%'.$request['search']['value'].'%')
          ->orWhere('description', 'like', '%'.$request['search']['value'].'%')->count();
        $data = $this->getVideoEntriesArray($items);
      }

    else{
      $items = Images::orderBy($orderBy, $orderType)
        ->offset($start)
        ->limit($length)
        ->get();
      $recordsTotal = Images::count();
      $recordsFiltered = $recordsTotal;
      $data = $this->getVideoEntriesArray($items);
    }
      $output = array(
          "sEcho" => intval($draw),
          "iTotalRecords" => $recordsTotal,
          "iTotalDisplayRecords" => $recordsFiltered,
          "aaData" => json_decode(json_encode($data))
       );
       return json_encode($output);
    }







    public function getVideoEntriesArray($items){
        foreach ($items as $item){
          $cover_photo = $item->getThumbnail();
          //($item->category->player_settings_id != null ? dd(PlayerSettings::where('id',$item->category->player_settings_id)->first()) : "ne raboti");
           $cover = '<img style="max-height: 100px;" src="'.$cover_photo.'">';
          $edit = '<div class="btn-toolbar">'
            .action_row("videos/", $item->id, $item->title, ["edit", "delete"], true).
            '</div>';
          $checkbox_action = "<div class='btn-group'><input type='checkbox' class='checkbox_action_checkbox' name='checkbox_action_checkbox[]' value='".$item->id."'></div>";
          $endItem[] = array(
            'id' => $item->id,
            'title' => $item->keywords,
            'category' => $item->categories,
            'thumbnail' => $cover,
            'action' => $edit,
            'checkbox_action' => $checkbox_action
          );
        }
      return $endItem;
    }
}
