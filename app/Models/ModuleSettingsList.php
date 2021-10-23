<?php

namespace App\Models;

use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleSettingsList extends TitanCMSModel
{
  use SoftDeletes;

  protected $table = 'modules_settings_list';

  protected $guarded = ['id'];

  /**
   * Validation rules for this model
   */
  static public $rules = [
    'name' => 'required|min:3:max:255',
    'description' => 'min:3:max:512',
  ];

  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
  public static function getAllList()
  {
      return self::orderBy('created_at')->get()->pluck('name', 'id')->toArray();
  }


  public function sidebarable()
  {
      return $this->morphTo();
  }

}
