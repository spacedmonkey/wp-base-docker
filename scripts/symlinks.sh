#!/bin/bash

rm -rf wordpress.old
mv tmp/wordpress wordpress.new
cp -r tmp/wp-content wordpress.new
cp -r wp-content wordpress.new
cp -r wordpress/ wordpress.old/
cp -Rf wordpress.new/* wordpress
rm -rf wordpress.new
chmod 777 wordpress/ -R
rm -rf tmp;