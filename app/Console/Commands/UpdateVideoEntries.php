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

class UpdateVideoEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videorecord:update';
    protected $process;
    protected $command = "";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update video covers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(VideoRecords $videorecord)
    {
        parent::__construct();
    }


    public function displayAllVideos()
    {
      $videos = VideoRecords::all();
      return $videos;
    }

    public function displayAllImages()
    {
      $images = VideoRecordImages::all();
      return $images;
    }

    // public function updateItem($data, $id)
    // {
    //   $this->db->where('item_name', $id);
    //   $query = $this->db->update('item', $data);
    // }


    /**
     * Update the specified videoRecord in storage.
     *
     * @param Request $request
     * @return Response
     */
    protected function setCommand()
    {
      $video = $this->displayAllVideos();
      $images = $this->displayAllImages();

      $iddd = fopen("/home/adm1n/testtttttt.log", "w");

      foreach($video as $cart){
        $newNameVideos = str_replace(".mp4", ".png", $cart->file_name);
        switch (true) {
          case VideoRecordImages::where('filename', $newNameVideos)->get() == true :
            $videoRecordImage = VideoRecordImages::where('filename', $newNameVideos)->update([
              'updated_at' => $cart->created_at,
              'video_record_id' => $cart->id,
              'is_cover' => 't',
              'filename' => 'video_'.$newNameVideos
            ]);
            print_r($cart->id."\n");
            break;
          default:
            print_r($cart->name."\n");
            break;
        }
      }
      fclose($iddd);
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
      $this->setCommand();
      $this->constructProcess();
    }
}
