<?php
namespace App\Models;

use Bpocallaghan\Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip2locationClientStats extends TitanCMSModel
{
    //use SoftDeletes;
    protected $table = 'ip2location_client_stats';
}
