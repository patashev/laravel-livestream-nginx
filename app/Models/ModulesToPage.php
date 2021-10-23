<?php

namespace App\Models;

use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class PageContent
 * @mixin \Eloquent
 */
class ModulesToPage extends TitanCMSModel
{
  use SoftDeletes, Sidebarable;

  protected $table = 'modules_to_sidebars';

  protected $guarded = ['id'];

  protected $fillable = [
    'name',
    'content',
    'sidebar_types_id',
    'cities_id'
  ];

  /**
   * Validation rules for this model
   */
  static public $rules = [
      'name'              => 'requierd|min:3:max:255',
      'content'           => 'requierd',
      'parent_id'         => 'required|exists:pages,id',
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


  public function sidebars()
  {
     return $this->belongsTo('App\Models\Sidebars');
  }



  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
   public function sidebarType()
   {
        return $this->belongsTo('App\Models\SidebarTypes', 'sidebar_types_id', 'id');
   }


}
