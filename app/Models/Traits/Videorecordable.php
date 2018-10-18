<?php

namespace App\Models\Traits;

use App\Models\VideoRecordImages;

trait Videorecordable
{
    /**
     * Get the cover photo attribute
     * @return bool
     */
    public function getCoverPhotoAttribute()
    {
        $videos = $this->videos;
        if ($videos->count() >= 1) {
            // get the cover photo
            $video = $videos->where('is_cover', true)->first();
            if ($video) {
                return $video;
            }

            // no photo marked as cover - return first
            return $videos->first();
        }

        // no videos uploaded yet
        return false;
    }

    /**
     * Get all of the album's videos.
     */
    public function videos()
    {
        return $this->morphMany(VideoRecordImages::class, 'video_record');
    }
}