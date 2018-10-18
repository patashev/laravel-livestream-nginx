<?php $__env->startSection('content'); ?>
<style>
.vjs-watermark {
    position: absolute;
    display: inline;
    z-index: 2000;
}
</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span><?php echo e(isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Video record'); ?></span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <form method="POST" action="<?php echo e($selectedNavigation->url . (isset($item)? "/{$item->id}" : '')); ?>" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                        <input name="_method" type="hidden" value="<?php echo e(isset($item)? 'PUT':'POST'); ?>">

                        <fieldset>
                            <div class="row">
                                <div class="col col-xs-6">
                                    <div class="form-group <?php echo e(form_error_class('title', $errors)); ?>">
                                        <label for="id-title">Title</label>
                                        <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="<?php echo e(($errors && $errors->any()? old('title') : (isset($item)? $item->title : ''))); ?>">
                                        <?php echo form_error_message('title', $errors); ?>

                                    </div>
                                </div>

                                <div class="col col-xs-6">
                                    <div class="form-group <?php echo e(form_error_class('category_id', $errors)); ?>">
                                        <label for="category">Category</label>
                                        <?php echo form_select('category_id', ([0 => 'Please select a Category'] + $categories), ($errors && $errors->any()? old('category_id') : (isset($item)? $item->category_id : '')), ['class' => 'select2 form-control']); ?>

                                        <?php echo form_error_message('category_id', $errors); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php echo e(form_error_class('summary', $errors)); ?>">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Summary" value="<?php echo e(($errors && $errors->any()? old('name') : (isset($item)? $item->name : ''))); ?>">
                                <?php echo form_error_message('name', $errors); ?>

                            </div>

                            <div class="form-group <?php echo e(form_error_class('slug', $errors)); ?>">
                                <label for="slug">slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Please insert the Summary" value="<?php echo e(($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : ''))); ?>">
                                <?php echo form_error_message('slug', $errors); ?>

                            </div>


                            <div class="row">
                                <div class="col col-xs-6">
                                    <div class="form-group <?php echo e(form_error_class('active_from', $errors)); ?>">
                                        <label for="active_from">Active From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_from" placeholder="Please insert the Active From" value="<?php echo e(($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : ''))); ?>">
                                            <span class="input-group-addon" style="margin-left: 5px;font-size: xx-large;">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <?php echo form_error_message('active_from', $errors); ?>

                                    </div>
                                </div>

                                <div class="col col-xs-6">
                                    <div class="form-group <?php echo e(form_error_class('active_to', $errors)); ?>">
                                        <label for="active_to">Active To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Please insert the Active To" value="<?php echo e(($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : ''))); ?>">
                                            <span class="input-group-addon" style="margin-left: 5px;font-size: xx-large;">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <?php echo form_error_message('active_to', $errors); ?>

                                    </div>
                                </div>
                            </div>


                            <?php echo $__env->make('admin.video_records.images.photoable', ['submit' => false], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                            <div class="row">
                                <div class="col col-xs-12">
                                    <div class="form-group">
                                        <label for="active_to">Extendet info</label>
                                        <table class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Option</th>
                                                    <th width="30%">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($item->cover_photo)): ?>
                                                 <tr>
                                                    <td><strong>Choose Cover Photo directly from video frame</strong></td>
                                                    <td style="padding:10px;">
                                                      <strong>
                                                        <div class="wrapper">
                                                        <div class="videocontent">
                                                        <div class="live-player" width="100%">
                                                          <video id="video-js" class="video-js vjs-default-skin vjs-16-9" controls preload>
                                                            <input id="coverPhoto" type="hidden" value="<?php echo e($item->cover_photo->urlForName($item->cover_photo->thumb)); ?>">
                                                            <input id="videoId" type="hidden" value="<?php echo e($item->id); ?>">
                                                            <source
                                                                  src="https://newlive.bta.bg/vod/<?php echo e($item->file_name); ?>/index.m3u8"
                                                                  type="application/x-mpegURL">
                                                            </video>
                                            		        </div>
                                                      </div>
                                                    </div>
                                                      </strong>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><strong>Slug</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->slug : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Entry ID</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->entry_id : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Apy Key</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->apy_key : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Vcodec Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->vcodec_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Vcodec Long Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->vcodec_long_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Width</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->width : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Height</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->height : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Ratio</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->ratio : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Duration</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->duraction : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bit Rate</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->bit_rate : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Acodec Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->acodec_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Acodec Long Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->acodec_long_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Sample Rate</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->sample_rate : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Channels</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->channels : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Format Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->format_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Format Long Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->format_long_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>File Name</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->file_name : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>File Path</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->file_path : '')); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Prefix</strong></td>
                                                    <td><strong><?php echo e((isset($item)? $item->prefix : '')); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group <?php echo e(form_error_class('description', $errors)); ?>">
                                <label for="article-content">Description</label>
                                <textarea class="form-control summernote" id="article-content" name="description" rows="18"><?php echo e(($errors && $errors->any()? old('description') : (isset($item)? $item->description : ''))); ?></textarea>
                                <?php echo form_error_message('description', $errors); ?>

                            </div>
                        </fieldset>

                        <?php echo $__env->make('admin.partials.form_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script type="text/javascript" src="/js/video.js"></script>
<script type="text/javascript"  src="/js/videojs-contrib-hls.min.js"></script>
<script type="text/javascript"  src="/js/videojs.watermark.js"></script>
<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            setDateTimePickerRange('#active_from', '#active_to');
            initSummerNote('.summernote');
        })
        var videoId = $('#videoId').val();

        function stopvideo(){
          $(".video-js")[0].player.pause();
        }
         var Button = videojs.getComponent('Button');
         var MyButton = videojs.extend(Button, {
           constructor: function() {
             Button.apply(this, arguments);
             this.addClass('fa');
             this.addClass('fa-camera');
             this.addClass('fa-5x');
           },
           handleClick: function() {
              $.post('/admin/video-records/archive/'+videoId+'/time/'+player.currentTime(), function(response) {

              })
              //location.reload();
           }
         });
         videojs.registerComponent('MyButton', MyButton);
         var poster = $('#coverPhoto').val();
         var player = videojs('video-js',{
            "poster": poster,
            "fluid": true
          });
         player.getChild('controlBar').addChild('myButton', {});

         player.watermark({
              file: '/images/logo-mini.png',
              xpos: 50,
              ypos: 50,
              xrepeat: 0,
              opacity: 0.5,
          });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>