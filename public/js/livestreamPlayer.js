

function getPlayer(video_url){
  player = videojs('video-js',{
    "src": video_url,
    "fluid": true,
    "type": "application/x-mpegURL",
    "autoplay" : false,
  });
  return player;
}
