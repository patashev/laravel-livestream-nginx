<?php $__env->startSection('content'); ?>
<style>
.vjs-watermark {
    position: absolute;
    display: inline;
    z-index: 2000;
}
</style>
<form method="POST" action="<?php echo e($selectedNavigation->url . (isset($item)? "/{$item->id}" : '')); ?>" accept-charset="UTF-8" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-12">
      <?php echo $__env->make('admin.partials.info', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('admin.partials.form_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>
    <div class="row">
        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
        <input name="_method" type="hidden" value="<?php echo e(isset($item)? 'PUT':'POST'); ?>">
        <div class="col-lg-6">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span><?php echo e(isset($item)? 'Редактирай ' . $item->title . ' entry': 'Нов видео запис'); ?></span>
                    </h3>
                </div>

                <div class="box-body">
                  <fieldset>
                    <div class="form-group <?php echo e(form_error_class('title', $errors)); ?>">
                      <label for="id-title">Заглавие</label>
                      <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="<?php echo e(($errors && $errors->any()? old('title') : (isset($item)? $item->title : ''))); ?>">
                      <?php echo form_error_message('title', $errors); ?>

                    </div>
                    <div class="form-group <?php echo e(form_error_class('category_id', $errors)); ?>">
                      <label for="category">Категория</label>
                      <?php echo form_select('category_id', ([0 => 'Моля изберете категория'] + $categories), ($errors && $errors->any()? old('category_id') : (isset($item)? $item->category_id : '')), ['class' => 'select2 form-control']); ?>

                      <?php echo form_error_message('category_id', $errors); ?>

                    </div>


                    <div class="form-group <?php echo e(form_error_class('description', $errors)); ?>">
                      <label for="article-content">Описание</label>
                      <textarea class="form-control summernote" id="article-content" name="description" rows="18"><?php echo e(($errors && $errors->any()? old('description') : (isset($item)? $item->description : ''))); ?></textarea>
                      <?php echo form_error_message('description', $errors); ?>

                    </div>

                    <div class="form-group <?php echo e(form_error_class('summary', $errors)); ?>">
                      <label for="name">Кратко име</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Summary" value="<?php echo e(($errors && $errors->any()? old('name') : (isset($item)? $item->name : ''))); ?>">
                      <?php echo form_error_message('name', $errors); ?>

                    </div>

                    <div class="form-group <?php echo e(form_error_class('slug', $errors)); ?>">
                      <label for="slug">Слъг</label>
                      <input type="text" class="form-control" id="slug" name="slug" placeholder="Please insert the Summary" value="<?php echo e(($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : ''))); ?>">
                      <?php echo form_error_message('slug', $errors); ?>

                    </div>

                    <?php if(!isset($item)): ?>
                      <div class="form-group <?php echo e(form_error_class('file_name', $errors)); ?>">
                        <label for="file_name">Фаел</label>

                        <?php echo Form::file('file_name');; ?>

                        <?php echo form_error_message('file_name', $errors); ?>

                      </div>
                    <?php endif; ?>

                    <div class="form-group <?php echo e(form_error_class('active_from', $errors)); ?>">
                      <label for="active_from">Активно от</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_from" placeholder="Please insert the Active From" value="<?php echo e(($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : ''))); ?>">
                        <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </span>
                      </div>
                      <?php echo form_error_message('active_from', $errors); ?>

                    </div>

                    <div class="form-group <?php echo e(form_error_class('active_to', $errors)); ?>">
                      <label for="active_to">Активно До</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Please insert the Active To" value="<?php echo e(($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : ''))); ?>">
                        <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </span>
                      </div>
                      <?php echo form_error_message('active_to', $errors); ?>

                    </div>

                    <?php if(isset($item)): ?>
                      <div class="form-group">
                        <label for="tech_info">
                          <span>Техническа информация</span>
                        </label>
                        <a href="#" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#modal-tech-info">
                          <i class="fa fa-wrench"></i>
                        </a>
                      </div>
                    <?php endif; ?>
                </div>
            </div>
          </fieldset>
        </div>

      <div class="col-lg-6">
          <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <span><i class="fa fa-table"></i></span>
              <span>Избери заглавна снимка от кадър във видеото</span>
            </h3>
          </div>
          <div class="box-body">
            <?php if(isset($item)): ?>
              <?php if(isset($item->cover_photo)): ?>
              <div class="videocontent">
                <div class="live-player">
                  <video id="video-js"  class="video-js video-js-custom-skin" controls preload >
                    <input id="coverPhoto" type="hidden" value="<?php echo e(($item->cover_photo) ? $item->cover_photo->urlForName($item->cover_photo->thumb) : " "); ?>">
                    <input id="videoId" type="hidden" value="<?php echo e($item->id); ?>">
                    <source
                      src="/vod/<?php echo e($item->apy_key); ?>/<?php echo e($item->file_name); ?>/index.m3u8"
                      type="application/x-mpegURL">
                  </video>
                </div>
              </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>

        <?php if(isset($item)): ?>
          <?php echo $__env->make('admin.video_records.images.photoable', ['submit' => false], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
      </div>
</div>
</form>













<div class="modal fade" id="modal-tech-info" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Нотификации</h4>
      </div>
      <div class="modal-body">
        <table id="tbl-list-video" class="table table-striped table-bordered hover" style="width:100%"
               data-server="true"
               data-page-length="18"
        >
          <thead>
          <tr>
            <th>Option</th>
            <th>Value</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8" src="/js/video-script.js"></script>
    <script type="text/javascript"  src="/js/livestreamPlayer.js"></script>
    <script type="text/javascript" charset="utf-8">

        $(function ()
        {
            setDateTimePickerRange('#active_from', '#active_to');
            initSummerNote('.summernote');

<?php if (isset($item)):?>
initDatatablesAjaxVideoDetailes('#tbl-list-video', '<?php echo e(route('datatable/getVideoDetailes', $item->id)); ?>', 20);
<?php endif;?>
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
           }
         });
         videojs.registerComponent('MyButton', MyButton);
         var poster = $('#coverPhoto').val();

         // var player = videojs('video-js',{
         //    "poster": poster,
         //    "fluid": true
         //  });


         var player = getPlayer();



          <?php if(isset($item) && isset($item->category->player_settings)): ?>
            let logoFile = '/<?php echo $item->category->player_settings->logo_file_name; ?>';
            player.watermark({
              file: logoFile,
              xpos: 50,
              ypos: 50,
              xrepeat: 0,
              opacity: 0.5,
            });
          <?php endif; ?>

         player.getChild('controlBar').addChild('myButton', {});


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>