<?php

namespace App\Http\Controllers\Admin\VideoRecords;

use App\Models\VideoRecordPlaylist;
use App\Models\VideoRecords;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Models\VideoRecordPlaylistRelation;
use DataTables;

class VideoRecordPlaylists extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      save_resource_url();
      //$items = VideoRecordPlaylist::with(['category', 'photos'])->get();
      $items = VideoRecordPlaylist::all();

      return $this->view('video_records.playlists.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return $this->view('video_records.playlists.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $attributes = request()->validate(VideoRecordPlaylist::$rules, VideoRecordPlaylist::$messages);
      $playlist = $this->createEntry(VideoRecordPlaylist::class, $attributes);
      return redirect_to_resource();
    }



    public function getCoverPhoto($video){
      foreach ($video as $cover_photo){
        if ($cover_photo->is_cover == true) {
          return $cover_photo->urlForName($cover_photo->thumb);
        }
      }
    }



    public function getVideoEntriesArray($items){
      foreach ($items as $item){
          $cover_photo = "/uploads/videos/".$item->filename;
          $cover = '<a data-form="'.$item->video_entry_id.'"
              data-title="'.$item->title.'"
              data-video_url="/hls/'.$item->apy_key.'/'.$item->file_name.'/index.m3u8"
              data-video_poster="'.$cover_photo.'"
              data-sharing="'.($item->category->player_settings_id != null && $item->category->player_settings->sharing == 'true' ? "true" : "false").'"
              class="img" style="cursor: pointer;"
              data-toggle="modal"
              data-target="#modal-showSettings"
              data-playlist="true"
              data-modal_delete_url="fsdfsdfsd"
              title="Impersonate "'.$item->video_entry_id.'""
            >
              <img style="max-height: 100px;" src="'.$cover_photo.'">
          </a>';
              $edit = '<div class="btn-toolbar">'
              .action_row("videos/", $item->video_entry_id, $item->name, ["edit", "delete"], true).
              '</div>';
              $checkbox_action = "<div class='btn-group'><input type='checkbox' class='checkbox_remove_from_playlist_checkbox' name='checkbox_remove_from_playlist_checkbox[]' value='".$item->video_entry_id."'></div>";
          $endItem[] = array(
                'id' => $item->video_entry_id,
                'title' => $item->title,
                'Category' => $item->category->name,
                'thumb' => $cover,
                'created_at' =>  $item->created_at->toDateTimeString(),
                'checkbox_action' => $checkbox_action
              );
        }
        return $endItem;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoRecordPlaylist  $VideoRecordPlaylist
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      save_resource_url();
      $draw = $request["draw"];
      $orderByColumnIndex  = $request['order'][0]['column'];
      switch (true) {
        case $request['columns'][$orderByColumnIndex]['data'] == "Category":
          $orderBy = "category_id";
          break;
        default:
          $orderBy = $request['columns'][$orderByColumnIndex]['data'];
          break;
      }
      $orderType = $request['order'][0]['dir'];
      $start  = $request["start"];
      $length = $request['length'];
      $playListitem = VideoRecordPlaylist::where('id', $id)->first();

      $recordsTotal = $playListitem->getVideoItems()->count();
      $recordsFiltered = $recordsTotal;
      $data = $this->getVideoEntriesArray($playListitem->getVideoItems()
        //->where('title', 'like', '%'.$request['search']['value'].'%')
        ->orderBy($orderBy, $orderType)
        ->offset($start)
        ->limit($length)
        ->get());

      $output = array(
          "sEcho" => intval($draw),
          "iTotalRecords" => $recordsTotal,
          "iTotalDisplayRecords" => $recordsFiltered,
          "aaData" => json_decode(json_encode($data))
       );
       return json_encode($output);
    }






    /**
     * Show the Videoable's videos
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoRecordPlaylistRelation  $VideoRecordPlaylistRelation
     * @return mixed
     */
    function massRemoveFromPlaylist(VideoRecordPlaylistRelation  $VideoRecordPlaylistRelation, Request $request){
       $userId = $request->input('user_id');
       $playlistId = $request->input('playlist_id');
       $videoArray = $request->input('id');
       foreach ($videoArray as $key => $value) {
          $playlistRecords = $VideoRecordPlaylistRelation->where('created_by', '=', $userId)
            ->where('playlist_id', '=', $playlistId )
            ->where('video_entry_id', '=', $value)
            ->delete();
       }
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoRecordPlaylist  $VideoRecordPlaylist
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoRecordPlaylist $VideoRecordPlaylist, Request $request)
    {
      //$user = VideoRecordPlaylist::createdBy();
      return $this->view('video_records.playlists.create_edit')->with('item', $VideoRecordPlaylist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoRecordPlaylist  $VideoRecordPlaylist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoRecordPlaylist $VideoRecordPlaylist)
    {
      $attributes = request()->validate(VideoRecordPlaylist::$rules, VideoRecordPlaylist::$messages);
      $VideoRecordPlaylist = $this->updateEntry($VideoRecordPlaylist, $attributes);
      return redirect_to_resource();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoRecordPlaylist  $VideoRecordPlaylist
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoRecordPlaylist $VideoRecordPlaylist)
    {
        //
    }
}
