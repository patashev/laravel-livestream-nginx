<?php

namespace App\Http\Controllers\Website;

use App\Models\Changelog;
use App\Models\Testimonial;
use Redirect;
use App\Http\Requests;
use App\Models\Page;
use App\Models\Weather;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PagesController extends WebsiteController
{
    /**
     * Display a listing of page.
     *
     * @param      $slug1
     * @param null $slug2
     * @param null $slug3
     * @return Response
     */
    public function index($slug1, $slug2 = null, $slug3 = null)
    {
        $url = $this->getCurrentUrl();

        $page = Page::with('components.component')->where('url', $url)->first();
        if (!$page) {
            throw new NotFoundHttpException();
        }else{
          $sidebar = $page->pageSidebars()->orderBy('parent_id')->get();
          $children = $this->findChildrenPages($page);
          if (!$sidebar) {
              throw new NotFoundHttpException();
              return $this->view('pages.page')
                  ->with('activePage', $page)
                  ->with('childrenPages', $children);
          }else{
            return $this->view('pages.page')
                ->with('activePage', $page)
                ->with('childrenPages', $children)
                ->with('sidebar', $sidebar);
          }
        }
        // find out if its a 'main page' and get the children
    }


    /**
     * Get the children pages
     * @param Page $page
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function findChildrenPages(Page $page)
    {
        $pages = Page::where('parent_id', $page->id)->orderBy('header_order')->get();

        return $pages;
    }
}
