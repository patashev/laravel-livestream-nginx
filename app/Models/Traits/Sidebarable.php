<?php

namespace App\Models\Traits;

use App\Models\ModulesToPage;

trait Sidebarable
{
    /**
     * Get all of the album's photos.
     */
    public function sidebars()
    {
        return $this->morphMany(ModuleSettingsList::class, 'sidebarable');
    }
}
