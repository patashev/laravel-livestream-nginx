<?php
namespace App\Models;

use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weather extends TitanCMSModel
{
      use SoftDeletes;
      protected $table = 'sidebar_weather';

      protected $guarded = ['id'];

      /**
       * Validation rules for this model
       *
       * @var array
       */
      static public $rules = [
          'cities_id'         => 'required',
          'weather_type'      => 'required',
          'min-temp'          => 'required',
          'max-temp'          => 'required'
      ];


      /**
       * Get all the rows as an array (ready for dropdowns)
       *
       * @return array
       */
      public static function getAllLists()
      {
          return self::orderBy('created_at')->get()->pluck('cities_id', 'id')->toArray();
      }



      /**
       * Get all the rows as an array (ready for dropdowns)
       *
       * @return array
       */
       public function cities()
       {
            return $this->belongsTo('App\Models\City', 'cities_id', 'id');
       }


        /**
         * Get all the rows as an array (ready for dropdowns)
         *
         * @return array
         */
         public function weather_types()
         {
              return $this->belongsTo('App\Models\WeatherTypes', 'weather_type', 'id');
         }


}
