<?php
namespace App\Models;

use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use App\Models\Traits\Sidebarable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip2location extends TitanCMSModel
{
    use SoftDeletes;
    protected $table = 'ip2locations';
}
