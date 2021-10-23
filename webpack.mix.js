let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

var COMPILE = 'all';
var public = 'public';
var pathBase = 'resources/assets';

if (COMPILE == 'all') {
    // copy all the fonts
    mix.copy(pathBase + '/fonts', public + '/fonts');

    // copy all the sound
    // mix.copy(pathBase + '/sounds', public + '/sounds');

    // copy all the images
    mix.copy(pathBase + '/images', public + '/images');
}

// website assets
if (COMPILE == 'website' || COMPILE == 'all') {
    var path = pathBase + '/';
    var pathCSS = path + '/css/';
    var pathJS = path + '/js/';

    mix.sass('resources/assets/sass/vendor.scss', pathCSS )
        .setPublicPath('resources');

    mix.styles([
        pathCSS + 'vendor.css',
        pathCSS + 'vendor/animate.css',
        pathCSS + 'vendor/fancybox.css',
        pathCSS + 'vendor/font-awesome.css',
        pathCSS + 'vendor/jquery.fancybox.css',
        pathCSS + 'vendor/datatables.bootstrap.css',

        pathCSS + 'app/faq.css',
        pathCSS + 'app/colors.css',
        pathCSS + 'app/pricing.css',
        pathCSS + 'app/utilities.css',
        pathCSS + 'app/testimonials.css',


        // video.js
        'node_modules/video-js-6/video-js-6.2.6/video-js.css',
        pathCSS + 'vendor/vjs-custom-skin.css',
        'node_modules/videojs.socialShare.css',
        // //pathCSS + 'vendor/videojs-thumbnails.css',
        pathCSS + 'vendor/videojs-related.css',



        pathCSS + 'website.css',
        pathCSS + 'newsnet.css',
        pathCSS + 'overrides.css',
    ], public + '/css/website.css');

    // website javascripts
    mix.scripts([
        //pathJS + 'vendor/jquery-3.2.1.js',
        'node_modules/jquery/jquery.js',
        //'node_modules/popper.js/dist/popper.js',
        //pathJS + 'vendor/popper.js', // bootstrap dependency
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/esm/popper.js',
        pathJS + 'vendor/bootstrap.js',


        // datatables | 1.10.11
        pathJS + 'vendor/jquery.dataTables.js',
        pathJS + 'vendor/datatables.bootstrap.js',
        pathJS + 'vendor/datatables.responsive.js',
        pathJS + 'titan/datatables.js',

        pathJS + 'vendor/jquery.fancybox.min.js',
        pathJS + 'vendor/lazysizes.min.js',
        //pathJS + 'vendor/owl.carousel.min.js',

        //videojs
        'node_modules/video-js-6/video-js-6.2.6/video.js',
        //pathJS + 'vendor/videojs-contrib-hls.min.js',
        'node_modules/@videojs/http-streaming/dist/videojs-http-streaming.js',
        pathJS + 'vendor/videojs.watermark.js',
        'node_modules/videojs-socialshare/videojs.socialShare.js',

        // pathJS + 'vendor/video.js',
        // pathJS + 'vendor/videojs-contrib-hls.js',
        // pathJS + 'vendor/videojs.watermark.js',
        pathJS + 'vendor/videojs-playlist.js',
        pathJS + 'vendor/videojs-related.js',
        //pathJS + 'vendor/videojs.ga.min.js',
        //pathJS + 'vendor/videojs-resolution-switcher.js',

//        pathJS + 'titan/alerts.js',
//        pathJS + 'titan/buttons.js',
//        pathJS + 'titan/forms.js',
//        pathJS + 'titan/google_maps.js',
//        pathJS + 'titan/social_media.js',
//        pathJS + 'titan/pagination.js',
//        pathJS + 'titan/utils.js',




        pathJS + 'website.js',
    ], public + '/js/website.js');
}

// admin assets
if (COMPILE == 'admin' || COMPILE == 'all') {
    var path = pathBase + '/admin/';

    // copy all the fonts
    mix.copy(path + 'fonts', public + '/fonts');

    // copy all the sounds
    mix.copy(path + 'sounds', public + '/sounds');

    // copy all the images
    mix.copy(path + 'images', public + '/images/admin');

    var pathCSS = path + '/css/';


    mix.styles([

      // 'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',
      // 'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
      // 'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',

      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/themify-icons.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/metisMenu.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/owl.carousel.min.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/slicknav.min.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/typography.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/default-css.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/styles.css',
      // 'vendor/srtdash-admin-dashboard/srtdash/assets/css/responsive.css',

        // admin
        pathCSS + 'admin-lte/adminlte.css',
        pathCSS + 'skins/skin-blue.css',
        pathCSS +'jquery_ui/jquery-ui.css',

        'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css',
        'node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',

        pathCSS + 'vendor/bootstrap.css',
        pathCSS + 'vendor/bootstrap.css.map',
        pathCSS + 'vendor/bootstrap-grid.css',


        //pathCSS + 'vendor/bootstrap-datetimepicker.css',
        pathCSS + 'vendor/datatables.bootstrap.css',
        pathCSS + 'vendor/responsive.bootstrap.css',
        pathCSS + 'vendor/font-awesome.css',
        pathCSS + 'vendor/ionicons.css',
        'resources/assets/admin/css/dataTables.searchHighlight.css',



        // plugins
        pathCSS + 'vendor/select2.css',
        pathCSS + 'vendor/lightbox.css',
        pathCSS + 'vendor/dropzone.css',
        pathCSS + 'vendor/summernote.css',
        pathCSS + 'vendor/daterangepicker.css',
        pathCSS + 'vendor/pace-theme-flash.css',
        pathCSS + 'vendor/cropper.css',

        // video.js
        pathCSS + 'video_js/video-js.css',
        pathCSS + 'video_js/videojs.ads.css',
        pathCSS + 'video_js/videojs-contrib-ads.css',
        // pathCSS + 'vjs_skins/videojs-iplayer-theme.css',
        // pathCSS + 'vjs_skins/netflix_player.css',
        // pathCSS + 'vjs_skins/vjs_sublime_skin.css',
        //'bower_components/videojs-sublime-skin/dist/videojs-sublime-skin.css',
        pathCSS + 'vjs_skins/vjs-custom-skin.css',
        pathCSS + 'videojs-ssai.css',


        pathCSS + 'videojs.socialShare.css',
        pathCSS + 'videojs-ssai.css',
        pathCSS + 'vendor/videojs-thumbnails.css',
        pathCSS + 'vendor/videojs-related.css',




        pathCSS + 'admin-lte.css',
        //pathCSS + 'skins/skin-blue.css',
        // pathCSS + 'skins/skin-blue-light.css',
        pathCSS + 'skins/skin-black.css',
        // pathCSS + 'skins/skin-black-light.css',
        // pathCSS + 'skins/skin-green.css',
        // pathCSS + 'skins/skin-green-light.css',
        // pathCSS + 'skins/skin-purple.css',
        // pathCSS + 'skins/skin-purple-light.css',
        // pathCSS + 'skins/skin-red.css',
        // pathCSS + 'skins/skin-red-light.css',
        // pathCSS + 'skins/skin-yellow.css',
        // pathCSS + 'skins/skin-yellow-light.css',

        // // titan
       pathCSS + 'titan/titan.css',
       pathCSS + 'titan/charts.css',
       pathCSS + 'titan/superbox.css',
       pathCSS + 'titan/nestable.css',
       pathCSS + 'titan/datatables.css',
       pathCSS + 'titan/checkboxes.css',
       pathCSS + 'titan/notify.css',

        pathCSS + 'overrides.css',
    ], public + '/css/admin.css');

    var pathJS = path + '/js/';
    // admin javascripts
    mix.scripts([
        // jquery
        pathJS + 'vendor/jquery-3.2.1.js',
        pathJS +'jquery_ui/jquery-ui.js',


        // 'node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js',

        'node_modules/admin-lte/bower_components/moment/min/moment.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/esm/popper.js', // bootstrap dependency
        // 'node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.js',

        pathJS + 'vendor/bootstrap.js',


        'node_modules/admin-lte/bower_components/raphael/raphael.min.js',
        'node_modules/admin-lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
        'node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'node_modules/admin-lte/bower_components/jquery-knob/dist/jquery.knob.min.js',
        'node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js',



        //pathJS + 'vendor/bootstrap.js',

        // plugins
        pathJS + 'vendor/pace.js',
        pathJS + 'vendor/chart.js',
        pathJS + 'vendor/select2.js',
        pathJS + 'vendor/dropzone.js',
        pathJS + 'vendor/lightbox.js',
        pathJS + 'plugins/fastclick.js',
        pathJS + 'vendor/summernote.js',
        pathJS + 'vendor/jquery.nestable.js',
        pathJS + 'vendor/jquery.cookie.js',
        pathJS + 'vendor/cropper.js',

        'node_modules/admin-lte/bower_components/morris.js/morris.js',

        // date picker
        pathJS + 'vendor/moment.js',
        pathJS + 'vendor/daterangepicker.js',
        pathJS + 'vendor/bootstrap-datetimepicker.js',

        // 'node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js',
        // 'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',


        // datatables | 1.10.11
        // https://datatables.net/extensions/responsive/classes
        //pathJS + 'vendor/jquery.datatables.js',
        'node_modules/datatables/media/js/jquery.dataTables.js',
        pathJS + 'vendor/datatables.bootstrap.js',
        pathJS + 'vendor/datatables.responsive.js',

        'resources/assets/admin/js/dataTables.searchHighlight.min.js',
        'resources/assets/admin/js/jquery.highlight.js',

        // titan
//        pathJS + 'titan/titan.js',
//        pathJS + 'titan/buttons.js',
//        pathJS + 'titan/notify.js',
//        pathJS + 'titan/datatables.js',
//        pathJS + 'titan/pagination.js',
//        pathJS + 'titan/google_maps.js',
//        pathJS + 'titan/notifications.js',


        // 'node_modules/admin-lte/dist/js/adminlte.js',
        // 'node_modules/admin-lte/dist/js/pages/dashboard.js',
        // admin
        pathJS + 'admin-lte.js',
        //pathJS + 'admin.js',
        'resources/assets/admin/js/admin.js',
        'resources/assets/admin/js/titan/titan.js',
        'resources/assets/admin/js/titan/buttons.js',
        'resources/assets/admin/js/titan/notify.js',
        'resources/assets/admin/js/titan/datatables.js',
        'resources/assets/admin/js/titan/pagination.js',
        'resources/assets/admin/js/titan/google_maps.js',
        'resources/assets/admin/js/titan/notifications.js',

    ], public + '/js/admin.js');

    mix.scripts([
        //videojs
        pathJS + 'video_js/video.js',
        pathJS + 'customJsVideoPlayer.js',
        pathJS + 'videojs.socialShare.js',
        pathJS + 'video_js/videojs-playlist.js',
        pathJS + 'videojs-playlist-ui.js',

        pathJS + 'video_js/videojs.ads.js',
        // pathJS + 'video_js/videojs-contrib-ads.cjs.js',
        // pathJS + 'video_js/videojs-contrib-ads.es.js',
        // pathJS + 'video_js/videojs-contrib-ads.js',

        //'node_modules/video-js-6/video-js-6.2.6/video.js',
        //'node_modules/video.js/dist/video.js',
        'node_modules/videojs-hls-quality-selector/dist/videojs-hls-quality-selector.min.js',
        //pathJS + 'vendor/videojs.js',
        //pathJS + 'vendor/videojs-contrib-hls.min.js',
        //'node_modules/@videojs/http-streaming/dist/videojs-http-streaming.js',
        // pathJS + 'videojs-contrib-hls.min.js',
        pathJS + 'videojs-resolution-switcher.js',
        pathJS + 'videojs.watermark.js',
    ], public + '/js/video-script.js');

//    mix.sass('node_modules/video.js/src/css/video-js.scss', public + '/css/video-js-scss.css');
    //mix.sass('node_modules/videojs-sublime-skin/src/videojs-sublime-skin.sass', public + '/css/video-js-scss.css');
    //mix.less('node_modules/@hola.org/videojs-hola-skin/src/css/videojs-hola-skin.less', public + '/css/videojs-hola-skin.css');
}
