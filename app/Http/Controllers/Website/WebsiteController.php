<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Sidebars;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests;
use Titan\Controllers\TitanWebsiteController;
use App\Models\VideoRecords;
use App\Models\VideoRecordsCategory;
use App\Models\PlayerSettings;

class WebsiteController extends BaseWebsiteController
{
    protected $showPageBanner = true;

    protected $navigationLeft = [];

    protected $navigationRight = [];

    protected $footerNavigation = [];

    protected $navigationFeatured = [];

    protected $popularPages = [];

    protected $activePageTiers = [];

    protected $sidebar = [];

    function __construct()
    {
        parent::__construct();

        // as soon as controller is ready -  get the navigation
        $this->middleware(function ($request, $next) {


          $this->navigationFeatured = Page::getFeatured();
          //$this->navigationLeft = Page::getHeaderNavigationLeft();
          //$this->navigationRight = Page::getHeaderNavigationRight();
          $this->footerNavigation = Page::getFooterNavigationRight();
          $this->sidebar = $this->findCurrentPage()->pageSidebars();
          $this->popularPages = Page::getPopularPages();
          $this->activePageTiers = $this->findActivePageTiers();
          return $next($request);
        });
    }

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return parent::view($view, $data)//->with('navigationLeft', $this->navigationLeft)
            //->with('navigationRight', $this->navigationRight)
            ->with('footerNavigation', $this->footerNavigation)
            ->with('navigationFeatured', $this->navigationFeatured)
            ->with('popularPages', $this->popularPages)
            ->with('activePageTiers', $this->activePageTiers)
            ->with('banners', $this->getBanners())
            ->with('sidebar', $this->getSidebars())
            ->with('showPageBanner', $this->showPageBanner);
    }


    protected function getSidebars()
    {
        $sidebar = $this->page->pageSidebars;
        if (!$sidebar) {
          return null;
        }else{
          $itemSidebars = $sidebar->sidebars()->orderBy('parent_id', 'desc')->get();
          return $itemSidebars;
        }
    }





    protected function getBanners()
    {
        $items = $this->page->banners;
        // if no banners linked to page - get default
        if ($items->count() <= 0) {
            $items = Banner::active()
                ->where('is_website', 1)
                ->orderBy('list_order')
                ->get();
            $items->cattegory = "without_cat";
        }
        foreach ($items as $item);
        if($item->video_category_id){
          $items->videos = VideoRecordsCategory::where('id', $item->video_category_id)->first()->videosForBannersByCattegory;
          $items->cattegory = "with_cat";
        }
        return $items;
    }


    /**
     * Get the active page tiers and the parent
     * @return object
     */
    private function findActivePageTiers()
    {
        // if selected page has a parent
        // find all pages with same parent id
        // if more than 1 - valid
        // if less than 1 - return 'about us'

        $name = 'About Us';
        $items = collect();
        if ($this->page->parent_id > 0) {
            $rows = Page::where('parent_id', $this->page->parent_id)
                ->orderBy('header_order')
                ->get();

            if ($items->count() > 1) {
                $items = $rows;
                $name = $this->page->parent->name;
            }
        }

        return (object) [
            'name'  => $name,
            'items' => $items,
        ];
    }
}
