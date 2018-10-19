
#!/bin/bash
on_die () {
    pkill -KILL -P $$
}
trap 'on_die' TERM echo $(date +[%FT%TZ]) >> ['NGINX_DIR']/logs/HLS.log
['FFMPEG_DIR']/ffmpeg -re -i rtmp://['HOST_NAME']/live/$name -c:a libfdk_aac -b:a 32k -c:v libx264 -b:v 128K -f flv rtmp://['HOST_NAME']/hls/$name_low
['FFMPEG_DIR']/ffmpeg -re -i rtmp://['HOST_NAME']/live/$name -c:a libfdk_aac -b:a 64k -c:v libx264 -b:v 256k -f flv rtmp://['HOST_NAME']/hls/$name_mid
['FFMPEG_DIR']/ffmpeg -re -i rtmp://['HOST_NAME']/live/$name -c:a libfdk_aac -b:a 128k -c:v libx264 -b:v 512K -f flv rtmp://['HOST_NAME']/hls/$name_hi
sleep 30s
