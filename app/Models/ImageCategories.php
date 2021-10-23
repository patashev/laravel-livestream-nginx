<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Images;

class ImageCategories extends Model
{
  use NodeTrait;
  /**
   * Get all the rows as an array (ready for dropdowns)
   *
   * @return array
   */
  public static function getAllList()
  {
    return self::orderBy('title')->get()->pluck('title', 'id')->toArray();
  }

  public function images()
  {
     return $this->belongsToMany(
          Images::class,
          'image_categories_images',
          'category_id',
          'image_id');
  }

  public function __toString()
  {
      return $this->title();
  }
}
