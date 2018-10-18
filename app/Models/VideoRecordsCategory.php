<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
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
     * Get the articles
     */
    public function videorecords()
    {
        return $this->hasMany(VideoRecords::class, 'category_id', 'id');
    }

    /**
     * Get the articles
     */
    public function streamrecords()
    {
        return $this->hasMany(Stream::class, 'category_id', 'id');
    }
}
