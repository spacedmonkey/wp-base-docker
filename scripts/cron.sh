export PATH=/usr/local/bin:$PATH
cd /var/www
for url in $(bin/wp site list --field=domain --allow-root)
do
    bin/wp cron event run --due-now --allow-root --url=${url} 2>&1 &
done
wait