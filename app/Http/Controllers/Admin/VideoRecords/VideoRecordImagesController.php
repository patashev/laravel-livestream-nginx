<?php


namespace App\Http\Controllers\Admin\VideoRecords;

use Image;
use Redirect;

use App\Models\News;
use App\Models\Photo;
use App\Models\Article;
use App\Models\PhotoAlbum;


use App\Models\VideoRecords;
use App\Models\VideoRecordsCategory;
use App\Models\VideoRecordImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;
use Bpocallaghan\Titan\Models\Traits\ImageThumb;
use App\Http\Controllers\Admin\AdminController;
use DataTables;

class VideoRecordImagesController extends AdminController
{
    /**
     * Display a listing of photo.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        //$items = VideoRecordImages::get();
        //return $this->view('video_records.images.index')->with('items', $items);
        return $this->view('video_records.images.index');
    }


    /**
     * Show the video records for datatables.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function getVideoImages()
    {
      save_resource_url();
        $items = VideoRecordImages::all();
        //$categories = VideoRecordsCategory::getAllList();

        foreach ($items as $item){
            $cover = "<a class='dropdown-toggle' data-toggle='modal' data-target='#modal-player' href='#'>
                <img style='height: 50px;' src='/uploads/videos/".$item->filename."' title=''>
                </a>";

                $edit = '<div class="btn-toolbar">'
                .action_row("video-record-images/", $item->id, $item->name, ["edit", "delete"], true).
                '</div>';
            $endItem[] = array(
                  'id' => $item->id,
                  'name' => ($item->is_cover == true ? $item->name."(cover)" : $item->name),
                  'Image' =>$cover,
                  'created_at' =>  $item->created_at->toDateTimeString(),
                  'action' => $edit
                );
          }
        return DataTables::of(json_decode(json_encode($endItem)))
              // ->addColumn('action', function ($endItem) {
              //   return $edit;
              // })
              ->escapeColumns(['*'])
              ->make(true);
    }


    /**
     * Show the form for editing the specified videoRecord.
     *
     * @param VideoRecordImages $videoRecord
     * @return Response
     * @param Request $request
     */
    public function edit(VideoRecordImages $videoRecordImages, Request $request, $id)
    {
        $categories = VideoRecordsCategory::getAllList();
        $videoRecordImages = VideoRecordImages::where('id', $id)->get();
        foreach ($videoRecordImages as $videoRecord);
        return $this->view('video_records.images.create_edit', compact('categories'))
            ->with(['photoable' => $videoRecordImages, 'videos' => $videoRecord]);
    }








    /**
     * Upload a new photo to the album
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPhotos()
    {
        // upload the photo here
        $attributes = request()->validate(VideoRecordImages::$rules);

        // get the photoable
        $photoable = input('video_record_type')::find(input('video_record_id'));

        //dd($photoable);

        if (!$photoable) {
            return json_response_error('Whoops', 'We could not find the photoable.');
        }

        // move and create the photo
        $photo = $this->moveAndCreatePhoto($attributes['file'], $photoable);

        if (!$photo) {
            return json_response_error('Whoops', 'Something went wrong, please try again.');
        }

        return json_response(['id' => $photo->id]);
    }



    /**
     * Save Image in Storage, crop image and save in public/uploads/images
     * @param UploadedFile $file
     * @param              $videorecordableimage
     * @param array        $size
     * @return \Illuminate\Http\JsonResponse|static
     */
    private function moveAndCreatePhoto(
        UploadedFile $file,
        $videorecordableimage,
        $size = ['l' => [1024, 800], 's' => [250, 195]]
    ) {
        $extension = '.' . $file->extension();

        $name = token();
        $filename = $name . $extension;

        $path = upload_path('videos');
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return false;
        }

        if (isset($videorecordableimage::$LARGE_SIZE)) {
            $largeSize = $videorecordableimage::$LARGE_SIZE;
            $thumbSize = $videorecordableimage::$THUMB_SIZE;
        }
        else {
            $largeSize = $size['l'];
            $thumbSize = $size['s'];
        }

        // get file size
        //$bytes = $imageTmp->filesize();
        //if ($bytes && $bytes > 4000000) {
        //    return json_response_error('Sorry', 'The image is to large (max 3MB)');
        //}

        // save original
        $imageTmp->save($path . $name . VideoRecordImages::$originalAppend . $extension);

        /*// save large
        $imageTmp->fit($largeSize[0], $largeSize[1])->save($path . $filename);

        // save thumbnail from the original image
        $imageTmp->fit($thumbSize[0], $thumbSize[1])
            ->save($path . $name . Photo::$thumbAppend . $extension);*/

        // if width is the biggest - resize on max width
        if ($imageTmp->width() > $imageTmp->height()) {

            // resize the image to the large height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $largeSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb height and constrain aspect ratio (auto width)
            $imageTmp->resize(null, $thumbSize[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }
        else {
            // resize the image to the large width and constrain aspect ratio (auto height)
            $imageTmp->resize($largeSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $filename);

            // resize the image to the thumb width and constrain aspect ratio (auto width)
            $imageTmp->resize($thumbSize[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . $name . ImageThumb::$thumbAppend . $extension);
        }

        $originalName = $file->getClientOriginalName();
        $originalName = substr($originalName, 0, strpos($originalName, $extension));
        $name = strlen($originalName) <= 2 ? $videorecordableimage->name : $originalName;
        $video = VideoRecordImages::create([
            'filename'       => $filename,
            'video_record_id'   => $videorecordableimage->id,
            'video_record_type' => get_class($videorecordableimage),
            'name'           => strlen($name) < 2 ? 'Photo Name' : $name,
        ]);

        return $video;
    }




    /**
     * Update the video's name
     * @param VideoRecordImages $videos
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhotoName(VideoRecordImages $videos)
    {
        VideoRecordImages::find(\Request::segments()[2])->update(['name' => input('name')]);
        return json_response();
    }


    /**
     * Update the album's cover image
     * @param VideoRecordImages $videos
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhotoCover()
    {
        //$videorecordableimage = input('photoable_type')::find(input('photoable_id'));
        $video = input('photoable_type')::find(input('photoable_id'));
        VideoRecordImages::where('video_record_id', $video->id)
            ->where('video_record_type', input('photoable_type'))
            ->update(['is_cover' => false]);

        VideoRecordImages::where('id', input('photo_id'))
            ->where('video_record_type', input('photoable_type'))
            ->update(['is_cover' => true]);
        return json_response();
    }

    /**
     * Remove the specified photo from storage.
     *
     * @param VideoRecordImages $videos
     * @param VideoRecords $videoRecords
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function destroy(VideoRecordImages $videos, VideoRecords $videoRecords, Request $request, $id)
    {
        $video = $videos->find($id);
        $this->deleteEntry($video, request());
        log_activity('Photo Deleted', 'A Photo was successfully deleted', $video->title);
        //return redirect_to_resource();
        return redirect()->back();
    }


      /**
     * Show the Photoable's photos
     * Create / Edit / Delete the photos
     * @param $photoable
     * @param $photos
     * @return mixed
     */
    private function showPhotoable($photoable, $photos)
    {
        save_resource_url();
        return $this->view('video_records.images.create_edit')
            ->with('photoable', $photoable)
            ->with('photos', $photos);
    }

    /**
     * Show the News' photos
     * @param VideoRecords $news
     * @param Request $request
     * @return mixed
     */
    public function showNewsPhotos(VideoRecords $video, Request $request, $id)
    {
        $video = $video->find($id);
        return $this->showPhotoable($video, $video->videos);
    }


}
