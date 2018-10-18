<?php

namespace App\Http\Resources;

use App\Models\VideoRecords;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoRecordsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->id,
    //         'created_at' => $this->created_at
    //     ];
    // }
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
