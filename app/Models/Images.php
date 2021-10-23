<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImageCategories;
use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Titan\Models\Traits\ActiveTrait;

class Images extends TitanCMSModel
{

    public function categories()
    {
      return $this->belongsToMany(
            ImageCategories::class,
            'image_categories_images',
            'image_id',
            'category_id');
    }

    public function getThumbnail(){
      return $this->urlForName($this->volume, $this->preview);
    }


    /**
     * Get the url for the file name (specify thumb, default, original)
     * @param $name
     * @return string
     */
    public function urlForName($volume, $name)
    {
      return config('app.url') . '/uploads/data/'.$volume.'/previews/'.$name;
    }
}
