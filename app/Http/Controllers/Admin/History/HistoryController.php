<?php

namespace App\Http\Controllers\Admin\History;

use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\LogAdminActivity;
//use Titan\Controllers\TitanAdminController;
use Bpocallaghan\Titan\Http\Controllers\Admin\TitanAdminController;

class HistoryController extends TitanAdminController
{
    public function website()
    {
        $actions = LogActivity::get();

        return $this->view('history.website', compact('actions'));
    }

    public function admin()
    {
        $activities = LogAdminActivity::getLatest();

        return $this->view('history.admin', compact('activities'));
    }
}
