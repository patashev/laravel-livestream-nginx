<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidebarTypes extends TitanCMSModel
{
  use SoftDeletes;
  protected $table = 'sidebar_types';

  protected $guarded = ['id'];

  /**
   * Validation rules for this model
   *
   * @var array
   */
  static public $rules = [
      'type'          => 'required|min:3:max:255'
  ];



  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
  public static function getAllList()
  {
      return self::orderBy('created_at')->get()->pluck('type', 'id')->toArray();
  }

  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
   public function sidebarType()
   {
        return $this->hasOne('App\Models\ModulesToPage');
   }

}
