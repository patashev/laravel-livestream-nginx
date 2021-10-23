<?php

namespace App\Models;

use App\User;
//use Titan\Models\TitanCMSModel;

use Bpocallaghan\Titan\Models\TitanCMSModel;


use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Playlistable;

/**
 * Class VideoRecordPlaylist
 * @mixin \Eloquent
 */
class VideoRecordPlaylist extends TitanCMSModel
{
    use SoftDeletes, Playlistable;

    protected $table = 'video_record_playlists';

    protected $guarded = ['id'];
    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'       => 'required|min:3:max:512'
    ];

    /**
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    /**
     * Get the category
     */
     public function video_record_playlist_relation()
     {
       return $this->hasMany(VideoRecordPlaylistRelation::class, 'playlist_id', 'id');
     }



     /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\VideoRecords', 'id', 'video_entry_id');
    }

}
