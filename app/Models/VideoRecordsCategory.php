<?php

namespace App\Models;

//use Titan\Models\TitanCMSModel;

use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoRecordsCategory extends TitanCMSModel
{
    use SoftDeletes, HasSlug;

    protected $table = 'video_records_categories';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name' => 'required|min:3:max:255',
        'title_en' => 'min:3:max:512',
        'title_bg' => 'min:3:max:512',
        'player_settings_id'
    ];

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

    /**
     * Get the videos
    */
    public function videorecords()
    {
        return $this->hasMany('App\Models\VideoRecords', 'category_id', 'id');
    }


     /**
      * Get the player settings
      */
      public function player_settings()
      {
        return $this->hasOne(PlayerSettings::class, 'id', 'player_settings_id');
      }




















    /**
     * Get the top videos for banner by cattegory
    */
    public function videosForBannersByCattegory()
    {
        return $this->hasMany('App\Models\VideoRecords', 'category_id', 'id')->limit(5);
    }




    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

    /**
     * Get the streams
     */
    public function streamrecords()
    {
        return $this->hasMany(Stream::class, 'category_id', 'id');
    }
}
