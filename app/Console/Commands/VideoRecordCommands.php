<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Symfony\Component\Process\Process;
use \Symfony\Component\Console\Output\BufferedOutput;
use \Symfony\Component\Console\Input\ArrayInput;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;
use App\Models\Stream;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VideoRecordCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videorecord:stream {slug} {dirname} {basename} {--stop}';
    protected $dell = 'videorecord:delete';
    protected $process;
    protected $command = "";
    protected $processDelete;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commands to send stream as entry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(VideoRecords $videorecord)
    {
        $this->videorecord = $videorecord;
        parent::__construct();
    }

    protected function setCommand($slug)
    {
        if(!$this->option('stop')){
            $command = $_ENV['VIDEO_FFMPEG']." -i 'rtmp://".$_ENV['APP_HOSTNAME']."/live/${slug}' -c:v libx264 -profile:v baseline -b:v 512K -vf 'scale=1280:trunc(ow/a/2)*2' -f flv -c:a aac -ac 1 -strict -2 -b:a 128k ";
            $command = $command . "rtmp://".$_ENV['APP_HOSTNAME']."/show/${slug}_low -c:v libx264 -profile:v baseline -b:v 128K -vf 'scale=480:trunc(ow/a/2)*2' -f flv -c:a aac -ac 1 -strict -2 -b:a 32k ";
            $command = $command . "rtmp://".$_ENV['APP_HOSTNAME']."/show/${slug}_mid -c:v libx264 -profile:v baseline -b:v 256K -vf 'scale=720:trunc(ow/a/2)*2' -f flv -c:a aac -ac 1 -strict -2 -b:a 64k ";
            $command = $command . "rtmp://".$_ENV['APP_HOSTNAME']."/show/${slug}_high -c:v libx264 -profile:v baseline -b:v 512K -vf 'scale=1280:trunc(ow/a/2)*2' -f flv -c:a aac -ac 1 -strict -2 -b:a 128k ";


            $idd = fopen(storage_path('app/'.$slug.".handle"), 'r');
            $entryID = fread($idd,filesize(storage_path('app/'.$slug.".handle")));
            $this->createEmptyEntry($slug, $entryID);
            fclose($idd);
        }
        elseif ($this->option('--stop')) {
            $command = "echo $(date +[%FT%TZ]) convert ${basename}.flv >> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/${basename}_date.log";
        }
        $this->line($command);
        $this->command = $command;
    }

    protected function signal_handler($signal)
    {
        $this->process->stop(1, SIGINT);
        die;
    }

    protected function constructProcess()
    {
        $command = $this->command;
        $this->process = new Process('exec ' . $command);
        $this->process->setTimeout(3600);
        $this->process->start();
        pcntl_signal(SIGINT, function($signal) {
            $this->signal_handler($signal);
        });
        pcntl_signal(SIGTERM, function($signal) {
            $this->signal_handler($signal);
        });
        pcntl_signal(SIGHUP, function($signal) {
            $this->signal_handler($signal);
        });
        while($this->process->isRunning())
        {
            pcntl_signal_dispatch();
            usleep(1000);
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
        $dirname = $this->argument('dirname');
        $basename = $this->argument('basename');

        if($this->option('stop'))
        {
            exec("rm ".$_ENV['VIDEO_LIVE_PATH']."/${slug}.running");
            sleep(5);
            $files = explode("\n", shell_exec("find ".$_ENV['VIDEO_LIVE_PATH']."/'${slug}.m3u8' | grep ${slug}"));
            $logFile = fopen($_ENV['VIDEO_LIVE_PATH']."/test.log","w");
                foreach ($files as $filename) {
                    fwrite($logFile,$filename.'\n');
                    if(!empty($filename))
                    {
                        exec("sh -c \"echo '#EXT-X-ENDLIST' >> " . $filename . "\n");
                    }
                    exec("rm -f ".$_ENV['VIDEO_LIVE_PATH']."/'${slug}.m3u8'");

                    exec("find ".$_ENV['VIDEO_LIVE_PATH']."/${slug}* -type d", $folders);
                    foreach ($folders as $folder => $value) {
                        exec("rm -rf ".$value);
                    }
                }
                fwrite($logFile, $txt = $slug."---".$dirname."/".$basename.".flv");
                fclose($logFile);

                exec($_ENV['VIDEO_FFMPEG']." -i ${dirname}/${basename}.flv -vcodec copy -acodec copy -metadata title='${slug}' -crf 20 ${dirname}/${basename}.mp4 2>> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/ffmpeg-convert.log & wait 5");
                exec($_ENV['VIDEO_FFMPEG']." -i ${dirname}/${basename}.mp4 -updatefirst 1 -f image2 -vcodec mjpeg -vframes 1 -s 853x480 -y ".$_ENV['VIDEO_FFMPEG_IMAGE_DIR']."/video_${basename}.png >> ".$_ENV['VIDEO_FFMPEG_LOGS_DIR']."/ffmpeg-screenshots.log");
                exec("rm -f ${dirname}/${basename}.flv & wait 5");

                $fileName = $dirname."/".$basename.".mp4";
                $idd = fopen(storage_path('app/'.$slug.".handle"), 'r');
                $entryId = fread($idd,filesize(storage_path('app/'.$slug.".handle")));
                $imageVideoFile = "video_".$basename.".png";
                $this->createImageEntryForVideo($entryId, $slug, $imageVideoFile);
                $this->updateVideoEntry($slug, $entryId, $fileName, $dirname, $basename.".mp4");
        }else{
            exec("touch ".$_ENV['VIDEO_LIVE_PATH']."/${slug}.running");
            $files = explode("\n", shell_exec("find ".$_ENV['VIDEO_LIVE_PATH']."/${slug} -name '${slug}.m3u8' | grep ${slug}"));

            $entryIdFile = fopen(storage_path('app/'.$slug.".handle"), 'w');
            fwrite($entryIdFile, $this->v4('video_'));
            fclose($entryIdFile);

            $files = explode("\n", shell_exec("find ".$_ENV['VIDEO_LIVE_PATH']."/${slug} -name '*.ts' | grep ${slug}"));
            foreach($files as $file){
              if(!empty($file)){
                exec("rm ${file}");
              }
            }
            $this->setCommand($slug);
            $this->constructProcess();
            if(!$this->process->isSuccessful()){
                $this->error('Failed to start with Facebook Live enabled.');
                //$this->setCommand(false, $slug);
                //$this->constructProcess();
            }
        }

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

    /**
     * Store a newly created videoRecord in storage.
     * @return Response
     */
    public function updateVideoEntry($slug, $entry_id, $videoFileFullPath, $basedir, $videoFile)
    {
        $cmd = shell_exec('ffprobe -v quiet -print_format json -show_format -show_streams "'.$videoFileFullPath.'"');
        $exploaded_content = explode(":", $cmd);
        $content = self::praseArrForEntry($exploaded_content);

        $stream = Stream::where('slug', $slug)->get();
        foreach ($stream as $key => $str);
        $mytime = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:u', Carbon::now())->toDateTimeString();
        $nextWeek = Carbon::createFromFormat('Y-m-d H:i:u', $mytime)->addWeeks(1)->toDateTimeString();


        $attributes['name'] = $slug;
        $attributes['slug'] = $this->v4('stream_');
        $attributes['entry_id'] = $entry_id;
        $attributes['apy_key'] = $str->apy_key;
        $attributes['title'] = $str->title;
        $attributes['title'] = $str->description;
        $attributes['category_id'] = $str->category_id;
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
        $attributes['created_by'] = $str->created_by;
        $attributes['updated_by'] = $str->created_by;
        $item = VideoRecords::where('entry_id', $entry_id)->update($attributes);
        exec("rm -f ".storage_path('app/'.$slug.".handle"));
        return $item;
    }

    /**
     * Store a newly created videoRecord in storage.
     * @return Response
     */
    public function createEmptyEntry($slug, $entry_id)
    {
        $stream = Stream::where('slug', $slug)->get();
        foreach ($stream as $key => $str);
        $mytime = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:u', Carbon::now())->toDateTimeString();
        $nextWeek = Carbon::createFromFormat('Y-m-d H:i:u', $mytime)->addWeeks(1)->toDateTimeString();
        $attributes['name'] = $slug;
        $attributes['name'] = $slug;
        $attributes['entry_id'] = $entry_id;
        $attributes['apy_key'] = $slug;
        $attributes['title'] = $str->title;
        $attributes['description'] = $str->title;
        $attributes['category_id'] = $str->category_id;
        $attributes['prefix']  = 'video_';
        $attributes['status']  = 1;
        $attributes['active_from'] = $now;
        $attributes['active_to'] = $nextWeek;
        $attributes['created_by'] = $str->created_by;
        $attributes['updated_by'] = $str->created_by;
        $item = VideoRecords::create($attributes);
    }
}
