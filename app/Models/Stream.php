<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Model;
use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends TitanCMSModel
{
    use SoftDeletes, HasSlug;

    protected $table = 'streams';

        protected $guarded = ['id'];

    /**
     * Validation rules for this model
     *
     * @var array
     */
    static public $rules = [
        'name'          => 'required|min:3:max:255',
        'title'         => 'required|min:3:max:255',
        'description'   => 'required|min:3:max:255',
        'category_id' => 'required|exists:video_records_categories,id',
        'slug'          => 'nullable',
        'fbPageID'      => 'required|min:3:max:255',
        'fbPageToken'   => 'required|min:3:max:255',
        'fbStreamURL'   => 'required|min:3:max:255',
        'active_from' => 'nullable|date',
        'active_to'   => 'nullable|date',
    ];

    static public $messages = ['success' => 'done', 'error' => 'try again'];


    protected $appends = array('fbPageTitle', 'live');
    protected $hidden = array('fbPageID', 'fbPageToken', 'fbStreamURL', 'key');



    public function trackers()
    {
        return $this->hasMany('App\Modesl\Tracker');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = is_null($value) ? '' : $value;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = is_null($value) ? '' : $value;
    }

    public function setFbPageIDAttribute($value)
    {
        $this->attributes['fbPageID'] = is_null($value) ? '' : $value;
    }

    public function setFbPageTokenAttribute($value)
    {
        $this->attributes['fbPageToken'] = is_null($value) ? '' : $value;
    }

    public function getFbPageTitleAttribute()
    {
        $fbPageToken = $this->fbPageToken;
        $fbPageID = $this->fbPageID;
        if(empty($fbPageToken) || empty($fbPageID)) {
            return '';
        }
        $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $fb->setDefaultAccessToken($fbPageToken);
        try
        {
            $response = $fb->get('/' . $fbPageID);
        }
        catch(\Facebook\Exceptions\FacebookResponseException $e)
        {
            return 'Error: ' . $e->getMessage();
        }
        catch(\Facebook\Exceptions\FacebookSDKException $e)
        {
            return 'Error: ' . $e->getMessage();
        }
        $node = $response->getGraphObject();
        return $node->getProperty('name');
    }

    public function getLiveAttribute()
    {
        return file_exists("/HLS/live/" . $this->slug . ".running") && file_exists("/HLS/live/" . $this->slug . ".m3u8");
    }


    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(VideoRecordsCategory::class, 'category_id', 'id');
    }


    /**
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }



    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::orderBy('name')->get()->pluck('title_url', 'id')->toArray();
    }

}

