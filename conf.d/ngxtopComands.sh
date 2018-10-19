#!/bin/bash
on_die ()
{ pkill -KILL -P $$ }
$log = "['NGINX_DIR']/logs/access_new.log";
trap 'on_die' TERM
ngxtop -l "['NGINX_DIR']/logs/access_new.log" print common 2>&1 | tee ['PROJECT_DIR']/BOOTSTRAP/tmp_${1}-$(date +[%FT%TZ]).log
wait
