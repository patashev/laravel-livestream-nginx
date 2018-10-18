<?php

namespace App\Http\Controllers\Admin\VideoRecords;

use Image;
use Redirect;
use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Titan\Models\Traits\ImageThumb;
use App\Http\Controllers\Admin\AdminController;
use Titan\Controllers\TitanAdminController;
use DataTables;

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
        return $this->view('video_records.index');
    }

    public function getCoverPhoto($video){
      foreach ($video as $cover_photo){
        if ($cover_photo->is_cover == true) {
          return $cover_photo->urlForName($cover_photo->thumb);
        }
      }
    }




    /**
     * Show the video records for datatables.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function getVideos()
    {
      save_resource_url();
        $items = VideoRecords::with('videos')->orderBy('created_at', 'desc')->get();
        foreach ($items as $item){
            $cover_photo = $this->getCoverPhoto($item->videos);
            $cover = "<a class='dropdown-toggle' data-toggle='modal' data-target='#modal-player' href='#'>
                <img style='height: 50px;' src='".$cover_photo."' title=''>
                </a>";

                $edit = '<div class="btn-toolbar">'
                .action_row("videos/", $item->id, $item->name, ["edit", "delete"], true).
                '</div>';
            $endItem[] = array(
                  'id' => $item->id,
                  'title' => $item->title,
                  'Category' => $item->category->name,
                  'thumb' => $cover,
                  'created_at' =>  $item->created_at->toDateTimeString(),
                  'action' => $edit
                );
          }
        return DataTables::of(json_decode(json_encode($endItem)))
              // ->addColumn('action', function ($endItem) {
              //   return $edit;
              // })
              ->escapeColumns(['*'])
              ->make(true);
    }


    public function updateThmbnailWithCover(){
      $videos = VideoRecords::all();
      foreach ($videos as $video) {
        $cover = VideoRecordImages::where('name', $video->file_name)->get();
        //$update = "update video_record_image set is_cover = true, video_record_id = ".$video->id." where name = '".$video->file_name."';"."\n";
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
        return $this->view('video_records.create_edit', compact('categories'));
    }

    /**
     * Store a newly created videoRecord in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$attributes = request()->validate(VideoRecords::$rules, VideoRecords::$messages);
        $attributes['entry_id'] = $this->v4('video_');
        $attributes['active_from'] = input('active_from');
        $attributes['active_to'] = input('active_to');
        $item = $this->createEntry(VideoRecords::class, $attributes);
        return redirect_to_resource();

    }

    /**
     * Show the form for editing the specified videoRecord.
     *
     * @param VideoRecords $videoRecord
     * @return Response
     * @param Request $request
     */
    public function edit(VideoRecords $videoRecord, Request $request, $id)
    {
        $categories = VideoRecordsCategory::getAllList();
        $videoRecord = VideoRecords::where('id', $id)->with('videos')->get();
        foreach ($videoRecord as $videoRecord);
        $photos = VideoRecordImages::where('video_record_id', $id)->get();
        return $this->view('video_records.create_edit', compact('categories'))
            ->with('photoable', $videoRecord)
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
      * @return \Illuminate\Http\JsonResponse
      */
    public function archive(Request $request, $id, $time)
    {
      $video_record_type = 'App\Models\VideoRecords';
      save_resource_url();
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
   * Show the Photoable's photos
   * Create / Edit / Delete the photos
   * @return mixed
   */
   private function showPhotoable($video)
    {
      save_resource_url();
      $photoable = VideoRecordImages::where('video_record_id', $video)->get();
      return $this->view('video_records.images.create_edit')
          ->with('photoable', $photoable)
          ->with('photos', $photos);
    }
}
