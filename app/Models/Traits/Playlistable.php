<?php

namespace App\Models\Traits;

use App\Models\VideoRecordPlaylistRelation;
use App\Models\VideoRecords;

trait Playlistable{

  /**
   * Get the cover photo attribute
   * @return bool
   */
  public function getVideoItems()
  {
    $videos = VideoRecords::with('videos')
    ->with('category')
    ->join('video_record_images', 'video_record_images.video_record_id', '=', 'video_records.id')
    ->join('video_record_playlist_relations', 'video_record_playlist_relations.video_entry_id', '=', 'video_record_images.video_record_id')
      ->where('video_record_playlist_relations.playlist_id', '=', $this->video_record_playlist_relation[0]->playlist_id)
      ->where('video_record_playlist_relations.deleted_at', '=', null)
      ->where('video_record_images.is_cover', '=', true);
   return $videos;
  }



  public function getPathAttribute()
  {
      return $this->getVideoItems($this);
  }


  public function getCoverPhotoAttribute()
  {
      $video_playlist_relations = $this->video_record_playlist_relation;
      foreach ($video_playlist_relations as $video_playlist_relation) {
        if ($video_playlist_relations->count() >= 1) {
            // get the cover photo
            $video = VideoRecords::where('id', $video_playlist_relation->video_entry_id)->first();
            if ($video) {
                return $video;
            }
        }
      }
      return false;
  }
}
