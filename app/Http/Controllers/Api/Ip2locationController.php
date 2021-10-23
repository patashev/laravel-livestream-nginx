<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Ip2location;
use App\Models\Ip2locationClientStats;
use DateTime;

class Ip2locationController extends Controller
{
    public function getIPLocation($ip_address)
    {
      $result = DB::select('SELECT * FROM ip2locations WHERE inet_to_bigint(?) <= ip_to ORDER BY ip_from ASC LIMIT 1', array($ip_address));
      return $result;
    }

    public function convertIpAddressToIpNumber($ip_address)
    {
      $explode = explode('.', $ip_address);
      $ipNumber = $explode[0]*16777216 + $explode[1]*65536 + $explode[2]+256 + $explode[3];
      return $ipNumber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $pageId = explode('/', $request->server('HTTP_REFERER'));
      $geoData = $this->getIPLocation($request->ip());
      $insert_object = new \stdClass;
      foreach ($geoData as $key => $value) {
          $newInsertInStatsDB = new Ip2locationClientStats();
          $newInsertInStatsDB->ip_number = $this->convertIpAddressToIpNumber($request->ip());
          $newInsertInStatsDB->ip_address = $request->ip();
          $newInsertInStatsDB->date_action = date('Y-m-d H:i:s');
          $newInsertInStatsDB->country_code = $value->country_code;
          $newInsertInStatsDB->country_name = $value->country_name;
          $newInsertInStatsDB->region_name = $value->region_name;
          $newInsertInStatsDB->city_name = $value->city_name;
          $newInsertInStatsDB->latitude = $value->latitude;
          $newInsertInStatsDB->longitude = $value->longitude;
          $newInsertInStatsDB->zip_code = $value->zip_code;
          $newInsertInStatsDB->user_agent = $request->server('HTTP_USER_AGENT');
          $newInsertInStatsDB->stream_name = "test"; //$pageId[6]
          $newInsertInStatsDB->title = "test";
          $newInsertInStatsDB->ip_version = 22;
          //$newInsertInStatsDB->save();
          dd($newInsertInStatsDB);
      }
      return $insert_object;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertEntry(Request $request)
    {
      $pageId = explode('/', $request->server('HTTP_REFERER'));
      $geoData = $this->getIPLocation($request->ip());
      $insert_object = new \stdClass;
      foreach ($geoData as $key => $value) {
          $newInsertInStatsDB = new Ip2locationClientStats();
          $newInsertInStatsDB->ip_number = $this->convertIpAddressToIpNumber($request->ip());
          $newInsertInStatsDB->ip_address = $request->ip();
          $newInsertInStatsDB->date_action = date('Y-m-d H:i:s');
          $newInsertInStatsDB->country_code = $value->country_code;
          $newInsertInStatsDB->country_name = $value->country_name;
          $newInsertInStatsDB->region_name = $value->region_name;
          $newInsertInStatsDB->city_name = $value->city_name;
          $newInsertInStatsDB->latitude = $value->latitude;
          $newInsertInStatsDB->longitude = $value->longitude;
          $newInsertInStatsDB->zip_code = $value->zip_code;
          $newInsertInStatsDB->user_agent = $request->server('HTTP_USER_AGENT');
          $newInsertInStatsDB->stream_name = $request->guid; //"test"; //$pageId[6]
          $newInsertInStatsDB->title = $request->title;
          $newInsertInStatsDB->ip_version = 4;
          $newInsertInStatsDB->save();
          dd($newInsertInStatsDB);
      }
      return $insert_object;
    }


    private function getLabelsOfItmes($items){
      foreach ($items as $item){
        $labels[] = $item->date_action;
      }
      return $labels;
    }


    private function getDatasetsOfItmes($items){
      foreach ($items as $item)
      {
        $dataset[] = $item->count;
      }
      return $dataset;
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

      if(!empty($request['start']) & !empty($request['end'])){
        $start = $request['start'];
        $end = $request['end'];
      }else{
        $start = new \DateTime();
        $start->format('YY-mm-dd');
        $end = new \DateTime('-29 days');
        $end->format('YY-mm-dd');
      }


      $items = \Illuminate\Support\Facades\DB::table('ip2location_client_stats')->select(\Illuminate\Support\Facades\DB::raw('count(date_action)'))
        ->addSelect('date_action')
        ->whereBetween('date_action', [$start, $end])
        ->groupBy('date_action')
        ->orderBy('date_action', 'desc')
        ->get();


      $datasets = new \stdClass();
      $datasets->label = 'Видеа гледаемoст';
      $datasets->fillColor = 'rgba(60, 141, 188, 1)';
      $datasets->pointColor = '#3b8bba';
      $datasets->pointStrokeColor = 'rgba(60,141,188,1)';
      $datasets->pointHighlightFill = '#fff';
      $datasets->pointHighlightStroke = 'rgba(220, 220, 220, 1)';
      $datasets->data = self::getDatasetsOfItmes($items);


      $endOutputArray = array(
        'labels' => self::getLabelsOfItmes($items),
        'datasets' => [$datasets]
      );
      return json_encode($endOutputArray);
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
