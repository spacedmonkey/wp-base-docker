for url in $(docker exec -it wpbasedocker_phpfpm_1 bash -c "/var/www/bin/wp --allow-root --path=/var/www/html site list --field=domain")
do
    /usr/bin/curl -sS http://localhost/wp-cron.php?doing_wp_cron -H "host: ${url}" 2>&1 &
done
wait
