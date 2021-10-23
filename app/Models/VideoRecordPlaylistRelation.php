<?php
namespace App\Models;

use App\User;
//use Titan\Models\TitanCMSModel;

use Bpocallaghan\Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Playlistable;

/**
 * Class VideoRecordPlaylistRelation
 * @mixin \Eloquent
 */
class VideoRecordPlaylistRelation extends TitanCMSModel
{
    use SoftDeletes;
    protected $table = 'video_record_playlist_relations';
    protected $guarded = ['id'];

    /**
     * Get the video_record_playlist_relation_items
     */
    public function video_record_playlist_relation_items()
    {
       return $this->hasOne(VideoRecords::class, 'video_entry_id', 'id');
    }




}
