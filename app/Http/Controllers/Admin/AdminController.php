<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
// use Titan\Controllers\TitanAdminController;
use Bpocallaghan\Titan\Http\Controllers\Admin\TitanAdminController;
use DB;

class AdminController extends TitanAdminController
{
    /**
     * Generate a filename and try to move the file
     * @param $attributes
     * @return string
     * @throws ValidationException
     */
    protected function moveDocument(&$attributes)
    {
        // get and move file
        $file = $attributes['file'];
        $filename = token() . '.' . $file->extension();
        $file->move(upload_path('documents'), $filename);
        unset($attributes['file']); // remove from attributes

        if (!\File::exists(upload_path('documents') . $filename)) {
            $validator = \Validator::make([], ['file' => 'required'],
                ['file.required' => 'Something went wrong, we could not upload the file. Please try again.']);

            throw new ValidationException($validator);
        }

        return $filename;
    }


    public function getIPLocation($ip_address)
    {
        $result = DB::select('SELECT * FROM ip2locations WHERE inet_to_bigint(?) <= ip_to ORDER BY ip_from ASC LIMIT 1', array($ip_address));
        return $result;
    }
}
