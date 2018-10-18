<?php

namespace App\Models;


use App\User;
use Titan\Models\Traits\ActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class Setting
 * @mixin \Eloquent
 */
class Settings extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'settings';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
    	'name' => 'required|min:3:max:255',
    	'description' => 'required|min:3:max:2000',
    ];




    /**
     * Get the articles
     */
    public function modules()
    {
        return $this->hasMany(ModuleSettingsList::class, 'module_id', 'id');
    }
}
