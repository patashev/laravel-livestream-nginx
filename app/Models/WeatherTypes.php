<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;


class WeatherTypes extends TitanCMSModel
{
  use SoftDeletes;
  protected $table = 'sidebar_weather_types';

  protected $guarded = ['id'];

  /**
   * Validation rules for this model
   *
   * @var array
   */
  static public $rules = [
      'name'         => 'required',
      'icon_name'      => 'required'
  ];


  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
  public static function getAllLists()
  {
      return self::orderBy('created_at')->get()->pluck('name', 'id')->toArray();
  }

  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
   public function weather_types()
   {
        return $this->hasOne('App\Models\Weather', 'weather_type', 'id');
   }

}
