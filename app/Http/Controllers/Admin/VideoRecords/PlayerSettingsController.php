<?php


namespace App\Http\Controllers\Admin\VideoRecords;
use Redirect;
use Storage;
use App\Models\PlayerSettings;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Stream;
use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;

class PlayerSettingsController extends AdminController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      save_resource_url();
      $items = PlayerSettings::all();
      return $this->view('video_records.player_settings.index')->with('items', $items);
    }



    /**
     * Show the form for creating a new news.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('video_records.player_settings.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(PlayerSettings::$rules, PlayerSettings::$messages);
      dd($attributes);
        $this->createEntry(PlayerSettings::class, $attributes);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  PlayerSettings  $playerSettings
     * @return Response
     */
    public function show(PlayerSettings $playerSettings, $id)
    {
      $playerSettings = PlayerSettings::where('id', $id)->first();
        dd($playerSettings);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param PlayerSettings $playerSettings
     * @return Response
     */
    public function edit($id)
    {
      $playerSettings = PlayerSettings::where('id', $id)->get();
      foreach ($playerSettings as $playerSettings);
      $videos = VideoRecords::with('videos')->orderBy('created_at', 'desc')->get();
      $videoable = VideoRecords::where('id', $playerSettings->video_id)->get();

      if(count($videoable)>1){
        $o= new \stdClass();
        foreach ($videoable as $value);
        $o = $value;
      }else {
        $o= new \stdClass();
        $o->id = "0";
        $o->apy_key = '0';
        $o->file_name = '0';
      }


      $videoableImage = VideoRecordImages::where([
          ['video_record_id', '=', $o->id],
          ['is_cover', '=', true],
        ])->first();
      return $this->view('video_records.player_settings.create_edit')
          ->with('player_id', $id)
          ->with('video_previwe', $o)
          ->with('videoableImage', $videoableImage)
          ->with('videos', $videos)
          ->with('player_settings', $playerSettings);
    }



    public function createJavascriptFile()
    {
        $path = '/uploads/settings'.'/'.\Auth::user()->id;
        \File::isDirectory($path) ? '' : \File::makeDirectory($path, 0777, true, true);

        $fileContent = "player.watermark({
              file: fileUrl,
              xpos: 80,
              ypos: 80,
              width: 160,
              clickable: true,
              url: logoUrl,
              xrepeat: 0,
              opacity: (opacity.val()/10),
              debug: true
          });";
        $file = $path."/".\Auth::user()->id.".js";


        Storage::put($file, $fileContent);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PlayerSettings  $playerSettings
     * @return Response
     */
     public function updateOnlyVideo($stream_id, $id, $video_id)
     {
       $updateOnlyVideoSrc = PlayerSettings::find($id);
       $updateOnlyVideoSrc->video_id = $video_id;
       $updateOnlyVideoSrc->save();
       return $video_id;
     }




    /**
     * Update the specified resource in storage.
     * @param  PlayerSettings  $playerSettings
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $destinationPath = 'uploads/settings';
      $attributes = $request->validate(PlayerSettings::$rules, PlayerSettings::$messages);

      $playerSettings = PlayerSettings::where('id', $id)->get();
      foreach ($playerSettings as $playerSettings);

      $attributes['name'] = $request['name'];

      $attributes['description'] = $request['description'];
      $attributes['with_ads'] = ($request['with_ads'] == '1') ? true : false;
      $attributes['player_width'] = $request['player_width'];
      $attributes['constrain_proportions'] = ($request['constrain_proportions'] == '1') ? true : false;

      if ($request['with_logo'] == '1') {
        $attributes['with_logo'] = true;
        $file = $request->file('logo_file_name');
        if (isset($file)) {
          $path = public_path().'/uploads/settings'.'/'.\Auth::user()->id;
          if (\File::isDirectory($path)) {
          }else{
            \File::makeDirectory($path, 0777, true, true);
          }
        //  \File::cleanDirectory($path);
          $file->move($path."/",$file->getClientOriginalName());
          $attributes['logo_file_name'] = $destinationPath."/".\Auth::user()->id."/".$file->getClientOriginalName();
        }
        $attributes['logo_opacity'] = $request['logo_opacity'];
      }else{
        $attributes['with_logo'] = false;
      }
      $attributes['autoplay'] = ($request['autoplay'] == '1') ? true : false;
      $attributes['bootstrap'] = ($request['bootstrap'] == '1') ? true : false;
      $attributes['bootstrap'] = ($request['bootstrap'] == '1') ? true : false;
      $attributes['player_heigh'] = $request['player_heigh'];
      $attributes['logo_href'] = $request['logo_href'];
      $attributes['playlist'] = ($request['playlist'] == '1') ? true : false;
      $playerSettings = $this->updateEntry($playerSettings, $attributes);
      //$this->createJavascriptFile();
      return back();
    }


    /**
     * Remove the specified news from storage.
     *
     * @param PlayerSettings  $playerSettings
     * @param Request $request
     * @return Response
     */
    public function destroy($id)
    {
        $playerSettings = PlayerSettings::where('id', $id)->first();
        //$playerSettings->deleted_by = \Auth::user()->getId();
        $playerSettings->delete();
        //$this->deleteEntry($playerSettings, $request);
        return redirect_to_resource();
    }
}
