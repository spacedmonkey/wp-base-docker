#!/bin/sh
while read p; do
  cp /scripts/template.conf /etc/vhosts/$p.conf
  sed -i "s/~hostname~/$p/g" /etc/vhosts/$p.conf
done < /etc/letsencrypt/domains.conf

cp /scripts/default.conf /etc/vhosts/default.conf