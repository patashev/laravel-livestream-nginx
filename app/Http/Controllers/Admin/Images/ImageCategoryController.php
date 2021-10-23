<?php

namespace App\Http\Controllers\Admin\Images;

use App\Models\ImageCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Response;

class ImageCategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      return $this->view('images.index')->with('itemsHtml', $this->getCategoriesHtml());
    }


    /**
     * Generate the nestable html
     *
     * @param null $parent
     *
     * @return string
     */
    private function getCategoriesHtml($parent = null)
    {
      $html = '<ol class="dd-list">';

      if (!(isset($parent) && $parent)) {
        $items = ImageCategories::whereParentId(null, true)->get();
      }
      else {
        $items = ImageCategories::whereParentId($parent->id, true)->get();
      }

      foreach ($items as $key => $nav) {
        $html .= '<li class="dd-item" data-id="' . $nav->id . '">';
        $html .= '<div class="dd-handle">' . (strlen($nav->icon) > 1 ? '<i class="fa-fw fa fa-' . $nav->icon . '"></i> ' : '');
        $html .= $nav->title . ' ' . ($nav->is_hidden == 1? '(HIDDEN)':'') . ' <span style="float:right"> ' . $nav->url . ' </span>';
        $html .= "<a href='#' style='float:right; z-index: 10;'><i class='fa fa-eye info'></i></a></div>";
        $html .= $this->getCategoriesHtml($nav);
        $html .= '</li>';
      }

      $html .= '</ol>';

      return (count($items) >= 1 ? $html : '');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ImageCategories $imageCategories
     * @return Response
     */
    public function show(ImageCategories $imageCategories)
    {
        //
    }


  /**
   * Show the form for editing the specified resource.
   *
   * @param ImageCategories $imageCategories
   * @param Request $request
   * @param $id
   * @return Response
   */
    public function edit(ImageCategories $imageCategories, Request $request, $id)
    {
      $item = $imageCategories::where('id', '=', $id)->get();
      return $this->view('images.category_images.create_edit_category')
        ->with('item', $item[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param ImageCategories $imageCategories
     * @return Response
     */
    public function update(Request $request, ImageCategories $imageCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ImageCategories $imageCategories
     * @return Response
     */
    public function destroy(ImageCategories $imageCategories)
    {
        //
    }
}
