<?php
namespace App\Models;

use App\Models\Traits\Videorecordable;
use App\User;
use Bpocallaghan\Sluggable\HasSlug;
use Bpocallaghan\Sluggable\SlugOptions;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VideoRecords
 * @mixin \Eloquent
 */


class VideoRecords extends TitanCMSModel
{
    use SoftDeletes, HasSlug, ActiveTrait, Videorecordable;

    protected $table = 'video_records';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];
    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name'		  => 'required|min:3:max:255',
        'slug'		  => 'required|min:3:max:255',
		    'entry_id'  => 'nullable|string',
        'apy_key'  => 'nullable|string',
        'title'       => 'required|min:3:max:255',
        'description' => 'required|min:5:max:2000000000',
        'category_id' => 'required|exists:video_records_categories,id',
        'vcodec_name'  => 'nullable|string',
        'vcodec_long_name'  => 'nullable|string',
        'width'  => 'nullable|number',
        'height'  => 'nullable|number',
        'ratio'  => 'nullable|number',
        'duraction'  => 'nullable|number',
        'bit_rate'  => 'nullable|number',
        'acodec_name'  => 'nullable|string',
        'acodec_long_name'  => 'nullable|string',
        'sample_rate'  => 'nullable|number',
        'channels'  => 'nullable|number',
        'format_name'  => 'nullable|string',
        'format_long_name'  => 'nullable|string',
        'file_name'  => 'nullable|string',
        'file_path'  => 'nullable|string',
        'thumb_path'  => 'nullable|string',
        'prefix'  => 'nullable|string',
        'live_play_count'  => 'nullable|number',
        'status'  => 'nullable|number'
    ];

    static public $messages = ['success' => 'done', 'error' => 'try again'];


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
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(VideoRecordsCategory::class, 'category_id', 'id');
    }

    /**
     * Get the options for generating the slug.
     */
    protected function getSlugOptions()
    {
        return SlugOptions::create()->generateSlugFrom('name');
    }
}
