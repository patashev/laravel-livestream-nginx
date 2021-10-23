<?php

namespace App\Models;

//use Titan\Models\TitanCMSModel;

use Bpocallaghan\Titan\Models\TitanCMSModel;

use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerSettings extends TitanCMSModel
{
  /**
   * Validation rules for this model
   *
   * @var array
   */

  protected $guarded = ['id'];
  static public $rules = [
    'name'          => 'required|:unique|min:3:max:255',
    'description'   => 'required|min:3',
    'with_ads' => 'nullable',
    'player_width'      => 'required|min:3:max:4',
    'player_heigh'   => 'required|min:3:max:4',
    'logo_file_name'   => 'nullable|min:3:max:255',
    'logo_href'   => 'nullable|min:3',
    'constrain_proportions' => 'nullable',
    'with_logo' => 'nullable',
    'logo_opacity'   => 'nullable|min:1:max:2',
    'autoplay' => 'nullable',
    'bootstrap' => 'nullable',
    'sharing' => 'nullable',
    'video_id' => 'nullable',
    'playlist' => 'nullable',
    'deleted_by' => 'nullable'
  ];

  protected $fillable = [
    'name',
    'description',
    'with_ads',
    'player_width',
    'player_heigh',
    'logo_file_name',
    'logo_href',
    'constrain_proportions',
    'with_logo',
    'logo_opacity',
    'autoplay',
    'bootstrap',
    'sharing',
    'video_id',
    'playlist',
    'deleted_by'
  ];


  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
   public function stream()
   {
        return $this->belongsTo('App\Models\Stream');
   }


   /**
    * Get all the rows as an array (ready for dropdowns)
    *
    * @return array
    */
    public function videoCattegory()
    {
         return $this->belongsTo('App\Models\VideoRecordsCategory');
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
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }



    /**
     * Get the category
     */
    public function videoEntry($video_id)
    {
        return VideoRecords::where('id', $video_id)->first();
    }


    public function getCoverPhoto($video){
      foreach ($video as $cover_photo){
        if ($cover_photo->is_cover == true) {
          return $cover_photo->urlForName($cover_photo->thumb);
        }
      }
    }

}
