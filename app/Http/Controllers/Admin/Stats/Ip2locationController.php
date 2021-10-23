<?php

namespace App\Http\Controllers\Admin\Stats;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\ImageCategories;
use App\Models\Ip2location;
use App\Models\Ip2locationClientStats;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use \Rinvex\Statistics\Models\Datum;
use \Rinvex\Statistics\Models\Device;
use \Rinvex\Statistics\Models\Path;
use \Rinvex\Statistics\Models\Platform;

use \Rinvex\Statistics\Models\Request as RequestRinvex;
use \Rinvex\Statistics\Models\Geoip;


class Ip2locationController extends AdminController
{

    /**
     * Display a listing of videoRecord.
     *
     * @return Response
     */
    public function index()
    {
      save_resource_url();
      return $this->view('stats.index');
    }



    public function rinvexIncludeStats()
    {
      $pageViews = app('rinvex.statistics.datum')->limit(10)->get();
      //->where('path', request()->decodedPath())->first()->count;
      return \GuzzleHttp\json_decode(json_encode($pageViews), true);
    }




    /**
     * Show the video records for datatables.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function returnedRowedIpToLocations(Request $request)
    {
      save_resource_url();
      $draw = $request["draw"];


        $start = $request['start'];
        $end = $request['end'];

      $items = \Illuminate\Support\Facades\DB::table('ip2location_client_stats')->select(DB::raw('count(date_action)'))
        ->addSelect('date_action')
        ->addSelect('stream_name')
        ->addSelect('title')
        ->whereBetween('date_action', [$start, $end])
        ->groupBy(['title','date_action', 'stream_name'])
        ->orderBy('date_action', 'desc')
        ->get();


      $data = $this->getVideoEntriesArray($items);
      $output = array(
        "sEcho" => intval($draw),
        "iTotalRecords" => count($items),
        "iTotalDisplayRecords" => count($items),
        "aaData" => json_decode(json_encode($data))
      );
      return json_encode($output);
    }



    public function getVideoEntriesArray($items){
      foreach ($items as $item){


        $endItem[] = array(
          'date_action' => $item->date_action,
          'title' => $item->title,
          'count' => $item->count,
          'stream_name' => (!(User::where('api_key', $item->stream_name)->first()))
          // 'stream_name' => '<img src="/uploads/images/'.(!(User::where('api_key', $item->stream_name)->first()->image) ? '19bddcb706f420f5bbf1112c495103fad9b5a1af.jpeg' : User::where('api_key', $item->stream_name)->first()->image).'" class="rounded-circle img img-thumbnail right" style="border-radius:50%; max-height:80px;">'
        );
      }
      return $endItem;
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
     * @param  \App\Models\Ip2location  $ip2location
     * @return \Illuminate\Http\Response
     */
    public function show(Ip2location $ip2location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ip2location  $ip2location
     * @return \Illuminate\Http\Response
     */
    public function edit(Ip2location $ip2location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ip2location  $ip2location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ip2location $ip2location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ip2location  $ip2location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ip2location $ip2location)
    {
        //
    }
}
