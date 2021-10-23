$(document).ajaxStart(function() { Pace.restart(); });

function initAdmin()
{
    initTitan();

    $(".select2").select2();
    $('[data-toggle="tooltip"]').tooltip();
}



(function($) {
  "use strict";

  /*================================
  Preloader
  ==================================*/

  var preloader = $('#preloader');
  $(window).on('load', function() {
    setTimeout(function() {
      preloader.fadeOut('slow', function() { $(this).remove(); });
    }, 150)
  });






  /*================================
    Fullscreen Page
    ==================================*/

  if ($('#full-view').length) {

    var requestFullscreen = function(ele) {
      if (ele.requestFullscreen) {
        ele.requestFullscreen();
      } else if (ele.webkitRequestFullscreen) {
        ele.webkitRequestFullscreen();
      } else if (ele.mozRequestFullScreen) {
        ele.mozRequestFullScreen();
      } else if (ele.msRequestFullscreen) {
        ele.msRequestFullscreen();
      } else {
        console.log('Fullscreen API is not supported.');
      }
    };

    var exitFullscreen = function() {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else {
        console.log('Fullscreen API is not supported.');
      }
    };

    var fsDocButton = document.getElementById('full-view');
    var fsExitDocButton = document.getElementById('full-view-exit');

    fsDocButton.addEventListener('click', function(e) {
      e.preventDefault();
      requestFullscreen(document.documentElement);
      $('body').addClass('expanded');
    });

    fsExitDocButton.addEventListener('click', function(e) {
      e.preventDefault();
      exitFullscreen();
      $('body').removeClass('expanded');
    });
  }
})(jQuery);
