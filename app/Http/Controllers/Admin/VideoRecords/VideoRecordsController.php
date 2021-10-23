<?php

namespace App\Http\Controllers\Admin\VideoRecords;

use Illuminate\Http\JsonResponse;
use Image;
use Redirect;
use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;
use App\Models\VideoRecordPlaylist;
use App\Models\VideoRecordPlaylistRelation;
use App\Models\PlayerSettings;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Bpocallaghan\Titan\Models\Traits\ImageThumb;
use App\User;
use Auth;
use App\Http\Controllers\Admin\AdminController;
use Bpocallaghan\Titan\Http\Controllers\Admin\TitanAdminController;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Carbon\Carbon;


class VideoRecordsController extends AdminController
{
    public static function v4($prefix) {
        return sprintf($prefix.'%04x%04x%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff)
        );
    }
	/**
	 * Display a listing of videoRecord.
	 *
	 * @return Response
	 */
    public function index()
    {
        return $this->view('video_records.index')->with('categories', VideoRecordsCategory::getAllList());
    }

    public function getCoverPhoto($video){
      foreach ($video as $cover_photo){
        if ($cover_photo->is_cover) {
          return $cover_photo->urlForName($cover_photo->thumb, $cover_photo->api_key);
        }
      }
    }




    public function getVideoEntriesArray($items){
        foreach ($items as $item){
          $cover_photo = $this->getCoverPhoto($item->videos);
          //($item->category->player_settings_id != null ? dd(PlayerSettings::where('id',$item->category->player_settings_id)->first()) : "ne raboti");
          $cover = '<a href="#" data-form="'.$item->id.'"
              data-title="'.$item->title.'"
              data-video_url="/hls/'.$item->apy_key.'/'.$item->file_name.'/index.m3u8"
              data-video_poster="'.$cover_photo.'"
              data-sharing="'.($item->category->player_settings_id != null && $item->category->player_settings->sharing == 'true' ? "true" : "false").'"
              class="img" style="cursor: pointer;"
              data-toggle="modal" data-target="#modal-showSettings"
              title="Impersonate "'.$item->id.'""
              data-with_logo="'.($item->category->player_settings_id != null && $item->category->player_settings->with_logo == 'true' ? "true" : "false").'"
              data-logo_file_name="'.($item->category->player_settings_id != null && $item->category->player_settings->logo_file_name != null ? $item->category->player_settings->logo_file_name : "null").'"
              data-logo_url="'.($item->category->player_settings_id != null && $item->category->player_settings->logo_href != null ? $item->category->player_settings->logo_href : "null").'"
            >
              <img style="max-height: 100px;" src="'.$cover_photo.'">
          </a>';
          $edit = '<div class="btn-toolbar">'
            .action_row("videos/", $item->id, $item->name, ["edit", "delete"], true).
            '</div>';
          $checkbox_action = "<div class='btn-group'><input type='checkbox' class='checkbox_action_checkbox' name='checkbox_action_checkbox[]' value='".$item->id."'></div>";
          $endItem[] = array(
            'id' => $item->id,
            'title' => $item->title,
            'Category' => $item->category->name,
            'thumb' => $cover,
            'created_at' =>  $item->created_at->toDateTimeString(),
            'action' => $edit,
            'checkbox_action' => $checkbox_action
          );
        }
      return $endItem;
    }

    /**
     * Show the video records for datatables.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function getVideos(Request $request)
    {
      $draw = $request["draw"];
      $orderByColumnIndex  = $request['order'][0]['column'];
      switch (true) {
        case !empty($request['columns'][$orderByColumnIndex]['data']):
          $orderBy = $request['columns'][$orderByColumnIndex]['data'];
          break;
        default:
          $orderBy = 'created_at';
          break;
      }
      $orderType = $request['order'][0]['dir'];
      $start  = $request["start"];
      $length = $request['length'];
      $recordsTotal = VideoRecords::with('videos')->orderBy('created_at', 'desc')->count();



      if(!empty($request['search']['value']) and $request['category'] == '' ){
        $items = VideoRecords::with('videos')
          ->where('title', 'like', '%'.$request['search']['value'].'%')
          ->orWhere('description', 'like', '%'.$request['search']['value'].'%')
          ->orderBy($orderBy, $orderType)
          ->offset($start)
          ->limit($length)
          ->get();
        $recordsFiltered = VideoRecords::with('videos')
          ->where('title', 'like', '%'.$request['search']['value'].'%')
          ->orWhere('description', 'like', '%'.$request['search']['value'].'%')->count();
        $data = $this->getVideoEntriesArray($items);
      }

      elseif (!empty($request['search']['value']) and $request['category'] != '' ){
          $items = VideoRecords::with('videos')
            ->where('category_id', '=', $request['category'])
            ->where('title', 'like', '%'.$request['search']['value'].'%')
            ->orWhere('description', 'like', '%'.$request['search']['value'].'%')
            ->orderBy($orderBy, $orderType)
            ->offset($start)
            ->limit($length)
            ->get();
          $recordsTotal = VideoRecords::with('videos')
            ->where('category_id', '=', $request['category'])
            ->count();
        $recordsFiltered = $recordsTotal;
        $data = $this->getVideoEntriesArray($items);
      }

      elseif(empty($request['search']['value']) and !empty($request['category']) ){
        $items = VideoRecords::with('videos')
          ->where('category_id', '=', $request['category'])
          ->orderBy($orderBy, $orderType)
          ->offset($start)
          ->limit($length)
          ->get();
        $recordsTotal = VideoRecords::with('videos')
          ->where('category_id', '=', $request['category'])
          ->count();
        $recordsFiltered = $recordsTotal;
        $data = $this->getVideoEntriesArray($items);
      }

    else{
      $items = VideoRecords::with('videos')
        ->orderBy($orderBy, $orderType)
        ->offset($start)
        ->limit($length)
        ->get();
      $recordsTotal = VideoRecords::with('videos')
        ->count();
      $recordsFiltered = $recordsTotal;
      $data = $this->getVideoEntriesArray($items);
    }

//      else{
//        if (!empty($request['category'])){
//          $items = VideoRecords::with('videos')
//            ->where('category_id', '=', $request['category'])
//            ->orderBy($orderBy, $orderType)
//            ->offset($start)
//            ->limit($length)
//            ->get();
//          $recordsTotal = VideoRecords::with('videos')
//            ->where('category_id', '=', $request['category'])
//            ->count();
//        }else{
//          $items = VideoRecords::with('videos')
//            ->orderBy($orderBy, $orderType)
//            ->offset($start)
//            ->limit($length)
//            ->get();
//        }
//        $recordsFiltered = $recordsTotal;
//        $data = $this->getVideoEntriesArray($items);
//      }
      $output = array(
          "sEcho" => intval($draw),
          "iTotalRecords" => $recordsTotal,
          "iTotalDisplayRecords" => $recordsFiltered,
          "aaData" => json_decode(json_encode($data))
       );
       return json_encode($output);
    }


    /**
    * video details
    * @return JsonResponse
    */
    public function getVideoDetailes($id)
    {
      $items = VideoRecords::find($id)->toArray();
      foreach ($items as $key => $value) {
          $data[] = array(
            'Option' => $key,
            'Value' => $value
          );
      }
      $output = array(
          "aaData" => json_decode(json_encode($data))
       );
       return json_encode($output);
    }


    /**
    * Upload a new photo to the album
    * @return JsonResponse
    */
    public function getVideoByid($id)
    {
      $video = VideoRecords::find($id);
      $video_cover = VideoRecordImages::where('video_record_id', $id)->get();
      $retunResult[] = array(
          'video' => $video,
          'video_cover' => $video_cover
      );
      return $retunResult;
    }


    public function updateThmbnailWithCover(){
      $videos = VideoRecords::all();
      foreach ($videos as $video) {
        $cover = VideoRecordImages::where('name', $video->file_name)->get();
        $name = str_replace(".mp4", ".png", $video->file_name);
        \DB::table('video_record_images')
            ->where('name', $video->file_name)
            ->update(['is_cover' => true, 'video_record_id' => $video->id, 'filename' => "video_".$name]);
      }
    }

    /**
     * Show the form for creating a new videoRecord.
     * @param Request $request
     * @return Response
     */
    public function create()
    {
        $categories = VideoRecordsCategory::getAllList();
        $playerSettings = PlayerSettings::getAllList();
        return $this->view('video_records.create_edit', ['categories' => $categories, 'settings' => $playerSettings]);
    }



    public function absorbFile($file)
    {
      if ($file->getClientOriginalExtension() == 'flv')
      {
        $destinationPath = '/home/adm1n/HLS/rec/'.Auth::user()->api_key.'/';
        $img_dest_folder = '/nginx/livestream/laravel-admin-live/public/uploads/videos/';

        $file->move($destinationPath,$file->getClientOriginalName());
        $date = now()->timestamp;


        $videoFile = Auth::user()->api_key.'_'.$date.'_'.Auth::user()->stream_key;
        $videoFileImage = 'video_'.Auth::user()->api_key.'-'.$date.'-'.Auth::user()->stream_key;

        $cmd_convert_video = 'cd '.$destinationPath.' && /home/adm1n/ffmpeg/ffmpeg -i '.$file->getClientOriginalName().'  -vcodec copy -acodec copy -metadata title="12" -crf 20 '.$videoFile.'.mp4';
        $cmd_convert_video_image = 'cd '.$destinationPath.' && /home/adm1n/ffmpeg/ffmpeg -i '.$videoFile.'.mp4 -updatefirst 1 -f image2 -vcodec mjpeg -vframes 1 -s 853x480 -y '.$videoFileImage.'.png';
        $cmd_remove_source_video = 'cd '.$destinationPath.' && unlink '.$file->getClientOriginalName();


        $process_video = Process::fromShellCommandline(
          $cmd_convert_video
        );
        $process_video->run();
        $process_video->wait();

        $process_video_image = Process::fromShellCommandline(
          $cmd_convert_video_image
        );
        $process_video_image->run();
        $process_video_image->wait();

        $process_delete_source = Process::fromShellCommandline(
          $cmd_remove_source_video
        );
        $process_delete_source->run();
        $process_delete_source->wait();

        $returnArray = array(
          'file_path' => $destinationPath.Auth::user()->api_key.'/',
          'file_name' => $videoFile.'.mp4',
          'thumb_path' => $destinationPath.Auth::user()->api_key.'/',
          'destinationPath' => $destinationPath,
          'thumb' => $videoFileImage
        );

        return $returnArray;
      }
    }


  public function praseArrForEntry( $arrEntry )
  {
    $newArrForEntry[] = array(
      'vcodec_name' => strstr(str_replace('"', '', $arrEntry[3]), ',', true),
      'vcodec_long_name' => strstr(str_replace('"', '', $arrEntry[4]), ',', true),
      'width' => strstr(str_replace('"', '', $arrEntry[10]), ',', true),
      'height' => strstr(str_replace('"', '', $arrEntry[11]), ',', true),
      'ratio' => strstr(str_replace('"', '', $arrEntry[17]), ',', true),
      'duraction' => strstr(str_replace('"', '', $arrEntry[95]), ',', true),
      'bit_rate' => strstr(str_replace('"', '', $arrEntry[97]), ',', true),
      'acodec_name' => strstr(str_replace('"', '', $arrEntry[51]), ',', true),
      'acodec_long_name' => strstr(str_replace('"', '', $arrEntry[52]), ',', true),
      'sample_rate' => strstr(str_replace('"', '', $arrEntry[59]), ',', true),
      'channels' => strstr(str_replace('"', '', $arrEntry[60]), ',', true),
      'format_name' => strstr(str_replace('"', '', $arrEntry[92]), ',', true),
      'format_long_name' => strstr(str_replace('"', '', $arrEntry[93]), ',', true),
      'file_name' => strstr(str_replace('"', '', $arrEntry[103]), ',', true),
      'live_play_count' => '0',
      'status' => 'ready'
    );
    return $newArrForEntry;
  }




  /**
   * Store a newly created videoRecord in storage.
   * @return Response
   */
  public function updateVideoEntry($slug, $entry_id, $videoFileFullPath, $basedir, $videoFile, $thumbnail, $item)
  {
    $cmd = 'cd '.$basedir.' && ffprobe -v quiet -print_format json -show_format -show_streams "'.$videoFile.'"';
    $process = Process::fromShellCommandline(
      $cmd
    );
    $process->run();
    $process->wait();

    $mytime = Carbon::now();
    $now = Carbon::createFromFormat('Y-m-d H:i:u', Carbon::now())->toDateTimeString();
    $nextWeek = Carbon::createFromFormat('Y-m-d H:i:u', $mytime)->addWeeks(1)->toDateTimeString();

    $exploaded_content = explode(":", $process->getOutput());
    $content = self::praseArrForEntry($exploaded_content);

    $attributes['name'] = $slug;
    $attributes['slug'] = $this->v4('stream_');
    $attributes['entry_id'] = $entry_id;
    $attributes['apy_key'] = Auth::user()->api_key;
    $attributes['vcodec_name'] = $content[0]['vcodec_name'];
    $attributes['vcodec_long_name'] = $content[0]['vcodec_long_name'];
    $attributes['width'] = $content[0]['width'];
    $attributes['height'] = $content[0]['height'];
    $attributes['ratio'] = $content[0]['ratio'];
    $attributes['duraction'] = $content[0]['duraction'];
    $attributes['bit_rate'] = $content[0]['bit_rate'];
    $attributes['acodec_name'] = $content[0]['acodec_name'];
    $attributes['acodec_long_name'] = $content[0]['acodec_long_name'];
    $attributes['sample_rate'] = $content[0]['sample_rate'];
    $attributes['channels'] = $content[0]['channels'];
    $attributes['format_name'] = $content[0]['format_name'];
    $attributes['format_long_name'] = $content[0]['format_long_name'];
    $attributes['file_name'] = $videoFile;
    $attributes['file_path'] = $basedir;
    $attributes['prefix']  = 'video_';
    $attributes['status']  = 1;
    $attributes['active_from'] = $now;
    $attributes['active_to'] = $nextWeek;
    $attributes['created_by'] = Auth::user()->id;
    $attributes['updated_by'] = Auth::user()->id;

    $item->update($attributes);
    VideoRecordImages::create([
      'filename'       => $thumbnail.'.png',
      'video_record_id'   => $item->id,
      'video_record_type' => get_class($item),
      'name'           => strlen($thumbnail) < 2 ? 'Снимка име' : $thumbnail,
    ]);

    $destinationPath = '/home/adm1n/HLS/rec/'.Auth::user()->api_key;
    $img_dest_folder = '/home/adm1n/nginx/livestream/laravel-admin-live/public/uploads/videos/'.Auth::user()->api_key;

    $cmd_mv_video_image = 'cd '.$destinationPath.' && mv '.$thumbnail.'.png '.$img_dest_folder.$thumbnail.'.png';
    $process_move = Process::fromShellCommandline(
      $cmd_mv_video_image
    );
    $process_move->run();
    $process_move->wait();

    return $item;
  }

    /**
     * Store a newly created videoRecord in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(VideoRecords $videoRecord, Request $request)
    {
        // save_resource_url();
    	  $attributes = request()->validate(VideoRecords::$rules, VideoRecords::$messages);
        $file = $request->file('file_name');
        $convertedFile = $this->absorbFile($file);

        $attributes['entry_id'] = $this->v4('video_');
        $attributes['file_path'] = $convertedFile['file_path'];
        $attributes['file_name'] = $convertedFile['file_name'];
        $attributes['thumb_path'] = $convertedFile['thumb_path'];
        $attributes['active_from'] = input('active_from');
        $attributes['active_to'] = input('active_to');

        $item = $this->createEntry(VideoRecords::class, $attributes);


        $this->updateVideoEntry(
          $this->v4('video_'),
          $this->v4('video_'),
          $convertedFile['destinationPath'],
          $convertedFile['destinationPath'],
          $attributes['file_name'],
          $convertedFile['thumb'],
          $item
        );
        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified videoRecord.
     *
     * @param VideoRecords $videoRecord
     * @return Response
     * @param Request $request
     */
    public function edit(Request $request, $video_id)
    {
        $categories = VideoRecordsCategory::getAllList();
        $videoRecord = VideoRecords::where('id', $video_id)->get();
        foreach ($videoRecord as $videoRecord);
        $photos = VideoRecordImages::where('video_record_id', $video_id)->get();
        return $this->view('video_records.create_edit', compact('categories'))
            ->with('photoable', $videoRecord)
            ->with('folder_date', $videoRecord->created_at->format('dmY'))
            ->with('photos', $photos)
            ->with('item', $videoRecord);
    }


    /**
     * Update the specified videoRecord in storage.
     *
     * @param VideoRecords    $videoRecord
     * @param Request $request
     * @return Response
     */
    public function update(VideoRecords $videoRecord, Request $request, $id)
    {
        $attributes = request()->validate(VideoRecords::$rules, VideoRecords::$messages);
        $attributes['active_from'] = input('active_from');
        $attributes['active_to'] = input('active_to');
        $videoRecord = VideoRecords::where('id', $id)->get();
        foreach ($videoRecord as $videoRecord);
        $videoRecord = $this->updateEntry($videoRecord, $attributes);
        return redirect_to_resource();
    }

    /**
     * Remove the specified videoRecord from storage.
     *
     * @param VideoRecords    $videoRecord
     * @param Request $request
     * @return Response
     */
    public function destroy(VideoRecords $videoRecord, Request $request, $id)
    {
        $videoRecord = VideoRecords::where('id', $id)->get();
        foreach ($videoRecord as $videoRecord);
        $this->deleteEntry($videoRecord, $request);
        return back();
    }

     /**
      * Upload a new photo to the album
      * @param VideoRecords    $videoRecord
      * @param Request $request
      * @return JsonResponse
      */
    public function archive(Request $request, $id, $time)
    {
      $video_record_type = 'App\Models\VideoRecords';
      // save_resource_url();
      $videoRecord = $video_record_type::find($id);


      $ffmpeg = $_ENV['VIDEO_FFMPEG'];
      $input = $_ENV['VIDEO_STORAGE_PATH']."/".$videoRecord->file_name;
      $output_filename = $videoRecord->prefix.$videoRecord->apy_key.'-'.str_replace(".", "", $time).".png";
      $output = public_path()."/uploads/videos/".$output_filename;



      $extension = '.png';
      $originalName = $output_filename;
      $originalName = substr($originalName, 0, strpos($originalName, $extension));
      $name = strlen($originalName) <= 2 ? $videoRecord->name : $originalName;
      $video = VideoRecordImages::create([
          'filename'       => $output_filename,
          'video_record_id'   => $videoRecord->id,
          'video_record_type' => get_class($videoRecord),
          'name'           => strlen($output_filename) < 2 ? 'Photo Name' : $output_filename,
      ]);
      exec($ffmpeg." -i ".$input." -ss ".$time." -vframes 1 ".$output);
      $videoNew[] = $videoRecord->id;
      $this->showPhotoable($videoNew);
      return $video;
    }


  /**
   * Show the Videoable's videos
   * Create / Edit / Delete the videos
   * @return mixed
   */
   private function showPhotoable($video)
    {
      // save_resource_url();
      $photoable = VideoRecordImages::where('video_record_id', $video)->get();
      return $this->view('video_records.images.create_edit')
          ->with('photoable', $photoable);
    }


    function massDelete(Request $request){
       $videoArray = $request->input('id');
       $videos = VideoRecords::whereIn('id', $videoArray)->get();
       foreach ($videos as $video) {
         $video->delete();
       }
     }


     /**
      * Show the Videoable's videos
      * @return mixed
      */
     function massAddToPlaylist(Request $request){
        $videoArray = $request->input('id');
        foreach ($videoArray as $key => $value) {
            VideoRecordPlaylistRelation::firstOrCreate([
              'created_by' => Auth::user()->id,
              'playlist_id' => 1,
              'video_entry_id' => $value
            ]);
        }
      }

}
