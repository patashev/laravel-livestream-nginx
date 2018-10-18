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
      $embed_string = "<style>
      .info { background-color: #eee; border: thin solid #333; border-radius: 3px; padding: 0 5px; margin: 20px 0; }
      video { width: 100%; height: auto;}
    </style>
    <link href='https://".$_SERVER['SERVER_NAME']."/css/video-js.css' rel='stylesheet'>
    <script src='https://".$_SERVER['SERVER_NAME']."/js/video.js'></script>
      <script src='https://".$_SERVER['SERVER_NAME']."/js/videojs-contrib-hls.min.js'></script>
      <script src='https://".$_SERVER['SERVER_NAME']."/js/videojs.ga.min.js'></script>
      </head>
      <body>
      <video id='video-".$slug.$key."'
                      width='730'
                      height='430'
                      class='video-js vjs-default-skin'
                      controls
                      data-setup='{\"fluid\": true, \"ga\": {\"eventsToTrack\": [\"error\"]}}'
                      poster='https://".$_SERVER['SERVER_NAME']."/img/thumbs/thumb_".$slug.".png'
                      >
        <source src='https://".$_SERVER['SERVER_NAME']."/hls/".$slug.".m3u8' type='application/x-mpegURL'>
      </video>
      <script>
      $.getJSON('https://".$_SERVER['SERVER_NAME']."/admin/video-records/live-stream/getipstats', function(location, textStatus, jqXHR) {
        localStorage['ip'] =  location.ip;
        localStorage['el'] = $('.page-title h1').text();
        return String(localStorage.url);
      });
      ff = localStorage.url;
      function loadDoc() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log();
        }
      };
        xhttp.open('GET', ff, true);
        xhttp.send();
      }

      var videoId = document.getElementById('video-".$slug."');
      var player = videojs( videoId, {}, function() {
        this.ga();
      });
      player.play( loadDoc() );
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-19978293-1', 'auto');
        ga('send', {
          hitType: 'event',
          eventCategory: 'Videos',
          eventAction: 'play',
          eventLabel: 'BTA - ".$slug."'
        });
      </script>";
      return $embed_string;





      // $fileString = $_SERVER['DOCUMENT_ROOT']."/uploads/embed_codes/".$key.".txt";
      // $handle = fopen($fileString, "w");
      // fwrite($handle, $embed_string);
      // fclose($handle);
    }

}
