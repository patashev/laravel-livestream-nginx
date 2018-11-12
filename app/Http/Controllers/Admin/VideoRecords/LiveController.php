<?php

namespace App\Http\Controllers\Admin\VideoRecords;

use Redirect;

use App\Models\VideoRecordsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Tracker;
use App\Models\Stream;
use App\User;


class LiveController extends AdminController
{
    /**
    * Display a listing of streams.
    *
    * @return Response
    */
    public function index()
    {
        save_resource_url();
        $items = Stream::get();

        return $this->view('video_records.stream.livestream')->with('items', $items);
    }

    /**
     * Show the form for creating a new videoRecord.
     * @param Request $request
     * @return Response
     */
    public function create()
    {
        $categories = VideoRecordsCategory::getAllList();
        return $this->view('video_records.stream.create_edit', compact('categories'));
    }

    /**
     * Store a newly created stream in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store()
    {
        $attributes = request()->validate(Stream::$rules, Stream::$messages);
        $name = input('name');
        $attributes['slug'] = str_slug($name);
        $attributes['key'] = sha1(time() . $attributes['slug']);
        $attributes['fbStreamURL'] = '';

        $item = $this->createEntry(Stream::class, $attributes);
        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified stream.
     *
     * @param Stream $item
     * @return Response
     */
    public function edit(Stream $item, Request $request, $id)
    {
        $categories = VideoRecordsCategory::getAllList();
        $item = Stream::where('id', $id)->get();
        foreach ($item as $item);
        return $this->view('video_records.stream.create_edit', compact('categories'))->with('item', $item);
    }

    /**
     * Update the specified stream in storage.
     *
     * @param Stream $item
     * @param Request    $request
     * @return Response
     */
    public function update(Stream $item, Request $request, $id)
    {
        $attributes = request()->validate(Stream::$rules, Stream::$messages);
        $ifd = Stream::where('id', $id)->get();
        foreach ($ifd as $ifd);
        $this->updateEntry($ifd, $attributes);
        return redirect_to_resource();
    }

    /**
     * Update the specified stream in storage.
     *
     * @param Stream $item
     * @param Request    $request
     * @return Response
     */
    public function destroy(Stream $item, Request $request, $id)
    {
        $ifd = Stream::where('id', $id)->get();
        foreach ($ifd as $ifd);
        $this->deleteEntry($ifd, request());
        return redirect_to_resource();
    }


    /**
     * Update the specified stream in storage.
     *
     * @param Stream $item
     * @param Request    $request
     * @return Response
     */
    public function getipstats(){
      $data = array("ip" => $_SERVER['REMOTE_ADDR']);
      header('Content-Type: application/json');
      return json_encode($data);
    }

    public function saveAsTxt($id, $slug, $key)
    {
      $embed_string = "<link href='https://".$_SERVER['SERVER_NAME']."/css/video-js.css' rel='stylesheet'>
      <link href='https://".$_SERVER['SERVER_NAME']."/css/vjs-custom-skin.css' rel='stylesheet'>
      <script type='text/javascript' src='https://".$_SERVER['SERVER_NAME']."/js/video.js'></script>
      <script type='text/javascript'  src='https://".$_SERVER['SERVER_NAME']."/js/videojs-contrib-hls.min.js'></script>
      <script type='text/javascript'  src='https://".$_SERVER['SERVER_NAME']."/js/videojs.watermark.js'></script>
      <script src='https://".$_SERVER['SERVER_NAME']."/js/videojs.ga.min.js'></script>

      <video id='videojs-contrib-hls-player' class='video-js vjs-default-skin' width='720' controls>
        <source src='https://".$_SERVER['SERVER_NAME']."/live/".$slug.".m3u8' type='application/x-mpegURL'>
        <input id='videoSource' type='hidden' value='https://".$_SERVER['SERVER_NAME']."/live/".$slug.".m3u8'>
        <input id='videoPoster' type='hidden' value='https://".$_SERVER['SERVER_NAME']."/img/thumbs/thumb_".$slug.".png'>
      </video>
      <script>

      $(function() {
          var videoPoster = $('#videoPoster').val();
          var videoSource = $('#videoSource').val();
          var player = videojs('videojs-contrib-hls-player');
          player.src({
              src: videoSource,
              type: 'application/x-mpegURL',
              aspectRatio:'720:400',
              fluid: true
          });
          player.play();
      });
      </script>";
      return $embed_string;





      // $fileString = $_SERVER['DOCUMENT_ROOT']."/uploads/embed_codes/".$key.".txt";
      // $handle = fopen($fileString, "w");
      // fwrite($handle, $embed_string);
      // fclose($handle);
    }

}
