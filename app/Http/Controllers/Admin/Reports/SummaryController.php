<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Requests;
use App\Models\FAQ;
use App\Models\FeedbackPurchase;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Models\FeedbackArtwork;
use App\Models\FeedbackGigapan;
use App\Models\FeedbackPackage;
use App\Models\FeedbackContactUs;
use App\Models\FeedbackWeddingPackage;
use App\Http\Controllers\Admin\AdminController;

class SummaryController extends AdminController
{
  /**
   * Display a listing of client.
   *
   * @return Response
   */
    public function index()
    {
      $items = $this->getData();
      save_resource_url();

      return $this->view('reports.summary', compact('items'));
    }

    private function getData()
    {
        $result = [];

        $result[] = ['', ''];
        $result[] = ['<strong>Feedback Forms</strong>', ''];
        $result[] = ['Contact Us', FeedbackContactUs::count()];

        $result[] = ['', ''];
        $result[] = ['<strong>Item 2</strong>', ''];
        $result[] = ['Total xx', '0'];

        return $result;
    }
}
