<?php

namespace App\Http\Controllers\Admin\VideoRecords;

use App\Models\VideoRecordsCategory;
use App\Models\VideoRecords;
use App\Models\PlayerSettings;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class VideoRecordsCategoriesController extends AdminController
{
	/**
	 * Display a listing of videoRecordsCategory.
	 */
	public function index()
	{
		save_resource_url();
		return $this->view('video_records.categories.index')->with('items', VideoRecordsCategory::all());
	}

	/**
	 * Show the form for creating a new videoRecordsCategory.
	 */
	public function create()
	{
		$player_settings = PlayerSettings::getAllLists();
		return $this->view('video_records.categories.create_edit')->with('player_settings', $player_settings);
	}

	/**
	 * Store a newly created videoRecordsCategory in storage.
	 */
	public function store(Request $request)
	{
		$attributes = request()->validate(VideoRecordsCategory::$rules, VideoRecordsCategory::$messages);
    $category = $this->createEntry(VideoRecordsCategory::class, $attributes);
    return redirect_to_resource();
	}

	/**
	 * Display the specified videoRecordsCategory.
	 *
	 * @param VideoRecordsCategory $videoRecordsCategory
	 */
	public function show(VideoRecordsCategory $videoRecordsCategory)
	{
		//
	}

	/**
	 * Show the form for editing the specified videoRecordsCategory.
	 *
	 * @param VideoRecordsCategory $videoRecordsCategory
	 * @param Request $request
     */
    public function edit(VideoRecordsCategory $videoRecordsCategory, Request $request, $id)
	{
				$player_settings = PlayerSettings::getAllLists();
        $item = $videoRecordsCategory->where('id', $id)->get();
        foreach ($item as $item);
        return $this->view('video_records.categories.create_edit')
					->with('player_settings', $player_settings)
					->with('item', $item);
	}

	/**
	 * Update the specified videoRecordsCategory in storage.
	 *
	 * @param VideoRecordsCategory  $videoRecordsCategory
	 * @param Request    $request
  */
    public function update(Request $request, $id)
	{
		$videoRecordsCategory = VideoRecordsCategory::find($id);
		$attributes = $request->validate(VideoRecordsCategory::$rules, VideoRecordsCategory::$messages);
		$attributes['player_settings_id'] = $request['player_settings'][0];
		$this->updateEntry($videoRecordsCategory, $attributes);
		return redirect_to_resource();
	}

	/**
	 * Remove the specified videoRecordsCategory from storage.
	 *
	 * @param VideoRecordsCategory  $videoRecordsCategory
	 * @param Request  $request
	 * @param Request  $id
	 */
	public function destroy(VideoRecordsCategory $videoRecordsCategory, Request $request, $id)
	{
		$cat = $videoRecordsCategory->find($id);
		$this->deleteEntry($cat, $request);
        return redirect_to_resource();
	}
}
