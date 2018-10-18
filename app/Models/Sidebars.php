<?php
namespace App\Models;

use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sidebars extends TitanCMSModel
{
      use SoftDeletes;
      protected $table = 'sidebars';

      protected $guarded = ['id'];

      /**
       * Validation rules for this model
       *
       * @var array
       */
      static public $rules = [
          'sidebar_name'          => 'required|min:3:max:255',
          'sidebar_type'          => 'required|min:3:max:255',
      ];


      /**
       * Get all the rows as an array (ready for dropdowns)
       *
       * @return array
       */
      public static function getAllList()
      {
          return self::orderBy('created_at')->get()->pluck('sidebar_name', 'id')->toArray();
      }


      /**
       * Get all the rows as an array (ready for dropdowns)
       *
       * @return array
       */
       public function sidebars()
       {
            return $this->hasMany('App\Models\ModulesToPage', 'sidebars_id', 'id')->orderBy('parent_id', 'ASC');
       }


       /**
        * Get all the rows as an array (ready for dropdowns)
        *
        * @return array
        */
        public function pageSidebars()
        {
             return $this->belongsTo('App\Models\Page');
        }


}
