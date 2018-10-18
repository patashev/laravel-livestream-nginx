<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;

use SoapBox\Formatter\Formatter;

class VideoRecordsController extends Controller
{
    /**
     * Display a action of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->action == 'listing') {
            $listing = $this->listing($request);
            return $listing;
        }
        if ($request->action == 'total') {
            $count = $this->getTotalCount();
            return $count;
        }
        if ($request->action == 'show') {
            $show = $this->show($request->video_id);
            return $show;
        }
    }

    /**
     * Display a listing of the resource.
     *
  	 * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request)
    {
        if ($request->category != null) {
          $category = VideoRecordsCategory::where('slug', strip_tags($request->category))->get();
          foreach ($category as $key => $value) {
              $catid = array('id' => $value['id']);
          }
          $videos = VideoRecords::where('category_id', $catid['id'])
            ->with('videos')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->offset(($request->page - 1) * $request->limit + 1)
            ->limit($request->limit)
            ->get();
        }else {
          $videos = VideoRecords::with('videos')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->offset(($request->page - 1) * $request->limit + 1)
            ->limit($request->limit)
            ->get();
        }
      return \Response::json($videos);
    }


    /**
      * Display a count of the resource.
      *
      * @return \Illuminate\Http\Response
    */
    public function getTotalCount(){
      $count = VideoRecords::all()->count();
      return \Response::json($count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = VideoRecords::where('id', $id)
            ->with('videos')
            ->with('category')
            ->get();
        $similar_videos = VideoRecords::with('videos')->get();
        foreach ($video as $vid);

        $relatedItems = array();
        if (strlen($vid->title) > 3) {
           foreach ($similar_videos as $similar_video) {
                similar_text($similar_video->title, $vid->title, $percent);
                switch (true) {
                case $percent > 65 && $percent != 100:
                  $relatedItems[] = $similar_video;
                  break;
              }
           }
        }

        $object = new \StdClass();
        $object->video = $video;
        $object->related = $relatedItems;

        return \Response::json($object);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
