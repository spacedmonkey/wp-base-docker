#!/bin/sh
cp /scripts/default.conf /etc/vhosts/default.conf

current_hash=
while true; do
   list="$(ls /etc/letsencrypt/live)"
   for url in $list
   do
      /usr/bin/curl -sS http://localhost/wp-cron.php?doing_wp_cron -H "host: ${url}" 2>&1
   done

   new_hash="$(echo "$list" | md5sum)"
   if [ "$current_hash" != "$new_hash" ]; then
        for p in $list
        do
          cp /scripts/template.conf /etc/vhosts/$p.conf
          sed -i "s/~hostname~/$p/g" /etc/vhosts/$p.conf
        done
       # Keep new hash version
       current_hash="$new_hash"
    fi
   sleep 60
done
