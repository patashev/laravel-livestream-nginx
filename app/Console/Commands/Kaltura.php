<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kaltura\Client\Configuration as KalturaConfiguration;
use Kaltura\Client\Client as KalturaClient;
use Kaltura\Client\Enum\SessionType as KalturaSessionType;
use Kaltura\Client\Type\MediaEntryFilter as KalturaMediaEntryFilter;
use Kaltura\Client\Enum\EntryStatus as KalturaEntryStatus;
use Kaltura\Client\Enum\MediaType as KalturaMediaType;
use Kaltura\Client\Type\FilterPager as KalturaFilterPager;

use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;
use App\Models\Stream;
use Carbon\Carbon;

class Kaltura extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kaltura:list {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function v4($prefix) {
        return sprintf($prefix.'%04x%04x%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff)
        );
    }

    public function praseArrForEntry( $arrEntry, $entryId, $title, $description, $slug, $createdAt )
    {
       $newArrForEntry[] = array(
          'entry_id' => $entryId,
          'title' => $title,
          'description' => $description,
          'vcodec_name' => strstr(str_replace('"', '', $arrEntry[3]), ',', true),
          'vcodec_long_name' => strstr(str_replace('"', '', $arrEntry[4]), ',', true),
          'width' => strstr(str_replace('"', '', $arrEntry[10]), ',', true),
          'height' => strstr(str_replace('"', '', $arrEntry[11]), ',', true),
          'ratio' => strstr(str_replace('"', '', $arrEntry[16]), ',', true),
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
       return $this->createEntry($newArrForEntry, $slug, $createdAt);
    }



    /**
     * Store a newly created videoRecord in storage.
     * @return Response
     */
    public function createEntry($content, $slug, $createdAt)
    {
        $stream = Stream::where('slug', $slug)->get();
        foreach ($stream as $key => $str);
        $mytime = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:u', Carbon::now())->toDateTimeString();
        $nextWeek = Carbon::createFromFormat('Y-m-d H:i:u', $mytime)->addWeeks(1)->toDateTimeString();



        $attributes['name'] =  $content[0]['file_name'];
        $attributes['slug'] =  $slug.'-'.$content[0]['file_name'];
        $attributes['created_at'] =  $createdAt;
        $attributes['entry_id'] = $content[0]['entry_id'];
        $attributes['apy_key'] = $slug;
        $attributes['title'] = $content[0]['title'];
        $attributes['description'] = $content[0]['description'];
        $attributes['category_id'] = 1;
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
        $attributes['file_name'] = str_replace(' ', '', $content[0]['file_name'].".mp4");
        $attributes['file_path'] = '/home/adm1n/HLS/kaltura';
        $attributes['prefix']  = 'video_';
        $attributes['status']  = 1;
        // $attributes['active_from'] = $now;
        // $attributes['active_to'] = $nextWeek;
        $attributes['created_by'] = 1;
        $attributes['updated_by'] = 1;

        $imageVideoFile = 'video_'.$content[0]['entry_id'].".png";
        VideoRecords::create($attributes);
        return $this->createImageEntryForVideo($content[0]['entry_id'], $slug, $imageVideoFile);
    }


    public function createImageEntryForVideo($entry_id, $imageName, $imageVideoFile){
        $video = VideoRecords::where('entry_id', $entry_id)->get();
        foreach ($video as $video);
        $mytime = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:u', Carbon::now())->toDateTimeString();
        $attributes['is_cover'] = true;
        $attributes['name'] = $imageName;
        $attributes['filename'] = $imageVideoFile;
        $attributes['video_record_id'] = $video->id;
        $attributes['video_record_type'] = 'App\Models\VideoRecords';
        $attributes['created_by'] = $video->created_by;
        $attributes['updated_by'] = $video->created_by;
        $image = VideoRecordImages::create($attributes);
        return $image;
    }


    private function downloadFile($url, $path, $filename, $entryId, $title, $description, $slug, $createdAt)
    {
        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ('/home/adm1n/HLS/kaltura/'.$filename.".mp4", 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
            //exec($_ENV['VIDEO_FFMPEG']." -i /home/adm1n/HLS/kaltura/".$filename.".mp4 -vcodec copy -acodec copy -metadata title='".$filename."' -crf 20 /home/adm1n/HLS/kaltura/".$filename."-new.mp4 2>> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/ffmpeg-convert1.log & wait 5");
            exec($_ENV['VIDEO_FFMPEG']." -i /home/adm1n/HLS/kaltura/".$filename.".mp4 -f mp4 -vcodec libx264 -preset veryfast -profile:v main -acodec aac -metadata title='".$filename."' /home/adm1n/HLS/kaltura/".$filename."-new.mp4 -hide_banner 2>> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/ffmpeg-convert.log & wait 5");
            exec($_ENV['VIDEO_FFMPEG']." -i /home/adm1n/HLS/kaltura/".$filename.".mp4 -updatefirst 1 -f image2 -vcodec mjpeg -vframes 1 -s 853x480 -y /home/adm1n/HLS/kaltura/video_".$filename.".png 2>> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/ffmpeg-screenshots.log  & wait 5");
            exec("rm -f /home/adm1n/HLS/kaltura/".$filename.".mp4 & wait 5");
            exec("mv /home/adm1n/HLS/kaltura/".$filename."-new.mp4 /home/adm1n/HLS/kaltura/".$filename.".mp4 & wait 5");
            $cmd = shell_exec("ffprobe -v quiet -print_format json -show_format -show_streams /home/adm1n/HLS/kaltura/".$filename.".mp4");
            $exploaded_content = explode(":", $cmd);
            //dd($exploaded_content);
            return $this->praseArrForEntry($exploaded_content, $filename, $title, $description, $slug, $createdAt);
        }
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      $slug = $this->argument('slug');
      $config = new KalturaConfiguration();
      $config->serviceUrl = 'http://video2.bta.bg/';
      $client = new KalturaClient($config);
      $error = "";
      try
      {
         $ks = $client->generateSession(
           $_ENV['KALTURA_ADMIN_SECRET'],
           $_ENV['KALTURA_USER_ID'],
           KalturaSessionType::ADMIN,
           $_ENV['KALTURA_PARTNER_ID']
         );
      }
      catch (Exception $ex)
      {
        $error = $ex->getMessage();
      }
      if (!$error){
        $client->setKs($ks);
        $filter = new KalturaMediaEntryFilter();
        $filter->statusEqual = KalturaEntryStatus::READY;
        $filter->mediaTypeEqual = KalturaMediaType::VIDEO;
        $filter->categoriesMatchOr = 'Sofia';
        $filter->orderBy = "+createdAt";
        $filter->createdAtGreaterThanOrEqual = "1606391783";
        $pager = new KalturaFilterPager();
        $pager->pageSize = 1;
        $pager->pageIndex = 1;
        try {
           $response = $client->media->listAction($filter, $pager);
           //$response = $client->media->count($filter);
           // $entryId = '0_q1njow7y';
           // $version = null;
           // $response = $client->media->get($entryId, $version);
           //dd($response);
        }
        catch (Exception $ex){
          $error = $ex->getMessage();
        }
        $count = $response->totalCount;
      }

//      print $count."\n";

      foreach ($response->objects as $mediaEntry) {
         if (
           //$mediaEntry->id !== '0_rnc9vfgh' &&
        //      $mediaEntry->id !== '0_dhxthn5x' &&
        //      $mediaEntry->id !== '0_vhpjii55' &&
        //      $mediaEntry->id !== '0_wggufgf8' &&
        //      $mediaEntry->id !== '0_fw3uvn5l' &&
        //      $mediaEntry->id !== '0_cvetm10u' &&
        //      $mediaEntry->id !== '0_1h5agzuo' &&
        //      $mediaEntry->id !== '0_9k7d99bc' &&
        //      $mediaEntry->id !== '0_qrs0dnp7' &&
        //      $mediaEntry->id !== '0_r9scxf0q' &&
        //      $mediaEntry->id !== '0_a7fviw2n' &&
        //      $mediaEntry->id !== '0_mk8siwhr' ){

        //     $mediaEntry->id !== '0_1l8l3jpy' &&
        //     $mediaEntry->id !== '0_zgl7f6dj' &&
        //     $mediaEntry->id !== '0_q3z0n6p1' &&
        //     $mediaEntry->id !== '0_5pyiasl1' &&
        //     $mediaEntry->id !== '0_gmy49wxv' &&
        //     $mediaEntry->id !== '0_mi9xgq3m' &&
        //     $mediaEntry->id !== '0_pa0y6lk8' &&
        //     $mediaEntry->id !== '0_0gs7wbi2' &&
        //     $mediaEntry->id !== '0_10a83l2o' &&
        //     $mediaEntry->id !== '0_me4bru93' &&
        //     $mediaEntry->id !== '0_fy59hsnr' &&
             $mediaEntry->id !== '0_3thx0zd1'){
                $entry[] = array('entry' => $mediaEntry );
        }
      }

      foreach ($entry as $key) {
        $x = new \stdClass();
        $x->entry = $key['entry'];
        $title = $x->entry->name;
        $description = $x->entry->description;
        $formate = "Y-m-d H:i";
        $date = $x->entry->createdAt;
        $created_at = date($formate, $date);
        $filename = $slug.'-'.$date.'-'.$x->entry->id;
        $this->downloadFile($x->entry->downloadUrl, $x->entry->id, $filename, $this->v4('video_'), $title, $description, $slug, $x->entry->createdAt);
        print_r($x->entry->downloadUrl."---".$x->entry->createdAt."-------".$filename."\n");
      }
    }
}
