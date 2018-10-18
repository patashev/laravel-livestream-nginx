<?php

namespace App\Http\Controllers\Website;


use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;
use App\Models\Sidebars;
use App\Models\ModulesToPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

// use Kaltura\Client\Configuration as KalturaConfiguration;
// use Kaltura\Client\Client as KalturaClient;
// use Kaltura\Client\Enum\SessionType as KalturaSessionType;
// use Kaltura\Client\Type\MediaEntryFilter as KalturaMediaEntryFilter;
// use Kaltura\Client\Enum\EntryStatus as KalturaEntryStatus;
// use Kaltura\Client\Enum\MediaType as KalturaMediaType;
// use Kaltura\Client\Type\FilterPager as KalturaFilterPager;


class VideoController extends WebsiteController
{

    private $category;
    private $categories;

    public function getCoverPhoto($video){
      foreach ($video as $cover_photo){
        if ($cover_photo->is_cover == true) {
          return $cover_photo->urlForName($cover_photo->thumb);
        }
      }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index( Request  $request)
     {
         $perPage = 6;
         $page = input('page', 1);

         $sidebar = $this->page->pageSidebars;
         $itemSidebars = Sidebars::find($sidebar->id)->sidebars()->get();

         if ($request->category_id) {
           $baseUrl = config('app.url') . '/pages/videos/'.$request->category_id;
           $items = VideoRecords::where('category_id', $request->category_id)
              ->with('videos')
              ->orderBy('created_at', 'desc')->get();
         }else{
           $baseUrl = config('app.url') . '/pages/videos';
           $items = VideoRecords::with('videos')->orderBy('created_at', 'desc')->get();
         }
         $total = $items->count();
         // paginator
         $paginator = new LengthAwarePaginator(
           $items->forPage($page, $perPage),
           $items->count(),
           $perPage,
           $page,
           [
             'path' => $baseUrl,
             'originalEntries' => $total
           ]);
         if (request()->ajax()) {
             return response()->json(view('website.video.pagination')
                 ->with('paginator', $paginator)
                 ->with('categories', VideoRecordsCategory::all())
                 ->with('sidebar', $itemSidebars)
                 ->render());
         }
         return $this->view('video.albums', [
           "paginator" => $paginator,
           "categories" => VideoRecordsCategory::all()
         ]);
     }








     public function getCards( $item ){
       $cover_photo = $this->getCoverPhoto($item->videos);
       $cover = "<a href='/pages/videos/".$item->id."'>
           <img class='img img-thumbnail' style='min-width: 182px; float:left;' src='".$cover_photo."' title='' alt='".$item->title."'>
           </a>";
       $description =  substr( $item->description, 0, strrpos( substr( $item->description, 0, 335), ' ' ) );
       $card = '<div class="card no-gutters card-no-padding-no-borders">
                      <div class="card-header">
                        <h5 class="card-title">'.$item->title.'</h5>
                      </div>
                      <div class="card-body">
                        <div class="row no-gutters">
                          <div class="col-lg-8 no-gutters">
                            <p class="card-text">'.$description.'</p>
                          </div>
                          <div class="col-lg-4 no-gutters">
                            '.$cover.'
                            '.$item->created_at->toDateTimeString().'
                          </div>
                        </div>
                      </div>
                    </div>';
       return $card;
     }




     /**
      * Show the video records for datatables.
      *
      * @param  Request  $request
      * @param  int  $category
      * @return Response
      */
     public function getVideos(Request $request )
     {
       if ($request['category'] != null) {
         $items = VideoRecords::where('category_id', $request->category)
            ->with('videos')
            ->orderBy('created_at', 'desc');
       }else{
         $items = VideoRecords::with('videos')
                    ->orderBy('created_at', 'desc');
       }
         return DataTables::of($items)
                    ->addColumn('created_at', function($items){
                     return $items->created_at;
                    })
                    ->addColumn('title', function ($items) {
                     return $this->getCards($items);
                    })
                    ->orderColumn('created_at', '-created_at $1')
                    ->escapeColumns(['*'])
                    ->make(true);
     }





     public function showAlbum($id)
     {
         $album = VideoRecords::where('id', $id)->first();
         if(!$album) {
             return redirect('/videos');
         }


         $similar_videos = VideoRecords::with('videos')->get();
         $arrayAlbumTitle[] = preg_split('/\s+/', $album->title);
         $items = $album->videos;
         $this->addBreadcrumbLink($album->title, '/videos');

         $relatedItems = array();

         if (strlen($album->title) > 3) {
           foreach ($similar_videos as $similar_video) {
             similar_text($similar_video->title, $album->title, $percent);
             switch (true) {
               case $percent > 65 && $percent != 100:
                 $relatedItems[] = $similar_video;
                 break;
             }
           }
         }
         if ($relatedItems) {
           return $this->view('video.album_show')
                ->with('album', $album)
                ->with('related', $relatedItems);
         }else {
           return $this->view('video.album_show')
                ->with('album', $album);
         }
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
     * @param  \App\Models\VideoRecords  $videoRecords
     * @return \Illuminate\Http\Response
     */
    public function show(VideoRecords $videoRecords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoRecords  $videoRecords
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoRecords $videoRecords)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoRecords  $videoRecords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoRecords $videoRecords)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoRecords  $videoRecords
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoRecords $videoRecords)
    {
        //
    }
}
