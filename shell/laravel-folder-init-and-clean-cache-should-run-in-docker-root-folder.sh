#!/bin/bash

mkdir -p public_html/storage/cms/cache/
mkdir -p public_html/storage/cms/twig/
mkdir -p public_html/storage/cms/combiner/
mkdir -p public_html/storage/framework/cache/
mkdir -p public_html/storage/framework/sessions/
mkdir -p public_html/storage/framework/views/
mkdir -p public_html/storage/logs/

rm -rf public_html/storage/cms/cache/*
rm -rf public_html/storage/cms/twig/*
rm -rf public_html/storage/cms/combiner/*
rm -rf public_html/storage/framework/cache/*
rm -rf public_html/storage/framework/sessions/*
rm -rf public_html/storage/framework/views/*
rm -rf public_html/storage/logs/*

chmod -R 775 public_html/storage/
#chmod 664 public_html/storage/*.key
cd public_html 
php artisan view:clear
php artisan config:cache                      

echo "run [chown -R user:apache . ] if it still has problem !"
