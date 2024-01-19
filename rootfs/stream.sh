#!/bin/bash
VIDSOURCE="/dev/video0"
#AUDIO_OPTS="-c:a aac -b:a 160000 -ac 2"
#VIDEO_OPTS="-s 854x480 -c:v libx264 -b:v 800000"
OUTPUT_HLS="-hls_time 10 -hls_list_size 10 -start_number 1"
/usr/bin/ffmpeg -i "$VIDSOURCE" -y $AUDIO_OPTS $VIDEO_OPTS $OUTPUT_HLS /var/www/html/Public/stream/webcam.m3u8