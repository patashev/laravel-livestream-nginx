<?php

namespace App\Models;

use Bpocallaghan\Titan\Models\Traits\ModifyBy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bpocallaghan\Sluggable\HasSlug;
use Bpocallaghan\Sluggable\SlugOptions;
use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Titan\Models\Traits\ActiveTrait;

/**
 * Class VideoRecordImages
 * @mixin \Eloquent
 */
class VideoRecordImages extends TitanCMSModel
{
    use SoftDeletes, ModifyBy;

    static public $thumbAppend = '';

    static public $originalAppend = '';

    protected $table = 'video_record_images';

    protected $guarded = ['id'];

    protected $appends = [ 'thumb', 'original', 'url'];

    static public $rules = [
        'file' => 'required|image|max:5000|mimes:jpg,jpeg,png,bmp'
    ];
    /**
     * Get the Tag many to many
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function videorecordable()
    {
        return $this->morphTo();
    }


    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     */
    public function getThumbAttribute()
    {
        return $this->appendBeforeExtension(self::$thumbAppend);
    }

    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     * original is reserved (original modal data)
     */
    public function getOriginalFilenameAttribute()
    {
        return $this->appendBeforeExtension(self::$originalAppend);
    }

    public function getExtensionAttribute()
    {
        return substr($this->filename, strpos($this->filename, '.'));
    }

    /**
     * Get the url to the video
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->urlForName($this->filename);
    }

    public function getThumbUrlAttribute()
    {
        return $this->urlForName($this->thumb);
    }

    public function getOriginalUrlAttribute()
    {
        return $this->urlForName($this->original_filename);
    }
    public function getOriginalAttribute()
    {
        return $this->urlForName($this->original_filename);
    }

    /**
     * Get the url for the file name (specify thumb, default, original)
     * @param $name
     * @param $apy_key
     * @return string
     */
    public function urlForName($name)
    {
        (isset($name) ? $apy_key = preg_split('/[\s_\-]+/', $name) : $this->videorecordable->apy_key);

        $apy_key = preg_split('/[\s_\-]+/', str_replace(' ', '', $this->name))[0];
        
        return config('app.url') . '/uploads/videos/'.$apy_key.'/'.$name;
    }

    /**
     * Apends a string before the extension
     * @param $append
     * @return mixed
     */
    private function appendBeforeExtension($append)
    {
        return substr_replace($this->filename, $append, strpos($this->filename, '.'), 0);
    }
}
