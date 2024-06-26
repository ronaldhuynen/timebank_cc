## TODO !
- Check Redis security: use a password etc!



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## DO NOT INSTALL, THIS REPO IS NOT READY FOR DEPLOYMENT

## Important Development commands:

php artisan servers           // Start development server at 127.0.0.
php artisan queue:work        // Executes queue worker in for mails and other queues
php artisan websockets:serve  // Start websocket server for messenger
npm run watch                 // Watches js / css / npm package changes in code and compiles when changed

php artisan optimize:clear    // Clears cached files: events, views, cache, route, config, compiled
php artisan optimize          // Rebuild cache of config and routes

All mail is being catched by mailtrap.io

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Licenses

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Laravel Jetsream: MIT
AlpineJs Alpine: MIT
Rtippin Messenger: MIT
Beyondcode Websockets: MIT

## SERVER INSTALLATION

# Debian 12 with Apache2, Php, mariaDB, Phpmyadmin, Webmin, Composer

As described on:
https://www.howtoforge.com/tutorial/debian-minimal-server/
https://www.howtoforge.com/how-to-install-webmin-on-debian-12/
https://kifarunix.com/install-phpmyadmin-on-debian-12/
https://www.howtoforge.com/how-to-install-laravel-on-debian-12/ (without laravel and virtual host setup)

Extra:
sudo ufw allow 80/tcp comment 'accept HTTP connections'
sudo ufw allow 443/tcp comment 'accept HTTPS connections'
sudo ufw allow 6001 comment 'accept Websocket connections'


Passwords are locally stored in keepass database:  dev.timebank.cc

Create unix dev user that installs the laravel app (in this example).


# Set Laravel file permissions

(not sure of this is needed / correct)
sudo apt install acl
sudo usermod -aG "www-data" "dev"
sudo find -L "/var/www/timebank_cc_dev" -type d -not -path "*/vendor/*" -not -path "*/	node_modules/*" -exec setfacl --default -m g::rwX {} \;
sudo find -L "/var/www/timebank_cc_dev" -type f -not -path "*/vendor/*" -not -path "*/node_modules/*" -exec chmod 664 {} \;
sudo find -L "/var/www/timebank_cc_dev" -type f -not -path "*/vendor/*" -not -path "*/node_modules/*" -exec chown "dev":"www-data" {} \;
sudo find -L "/var/www/timebank_cc_dev" -type d -not -path "*/vendor/*" -not -path "*/node_modules/*" -exec chmod 2775 {} \;
sudo find -L "/var/www/timebank_cc_dev" -type d -not -path "*/vendor/*" -not -path "*/node_modules/*" -exec chown "dev":"www-data" {} \;

As decribed on:
https://deploy-laravel.com/laravel-file-permissions



# Redis, Phpmyadmin, npm installed and Timebank_cc repo from Github


Redis installation with secure password
Phpmyadmin with custom virtual host:
sudo nano /etc/apache2/conf-available/phpmyadmin.conf
	Alias /admin/phpmyadmin /usr/share/phpmyadmin

sudo apt install npm
sudo -u www-data git pull https://github.com/ronaldhuynen/timebank_cc.git /var/www/timebank_cc_dev
sudo -u www-data npm install
sudo -u www-data npm run dev
sudo -u www-data php artisan db:seed
sudo -u www-data php artisan storage:link
sudo -u www-data db:seed

As described on:
https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-redis-on-ubuntu-22-04
https://kifarunix.com/install-phpmyadmin-on-debian-12/


# Setup systemd queue worker service
sudo nano /etc/systemd/system/dev.timebank.cc-queue.service

----


[Unit]
Description=Timebank.cc Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
WorkingDirectory=/var/www/timebank_cc_dev
ExecStart=/usr/bin/php artisan queue:work --sleep=3 --tries=5
SyslogIdentifier=dev.timebank.cc-queue

[Install]
WantedBy=multi-user.target


----
sudo systemctl daemon-reload
sudo systemctl enable dev.timebank.cc-queue.service
sudo systemctl start dev.timebank.cc-queue.service
sudo systemctl status dev.timebank.cc-queue.service




# Timedatectl, Htop, Letsencrypt certificate, Elasticsearch

Set Internet time server:
sudo apt-get update
sudo apt-get install ntp
sudo systemctl start ntp
timedatectl set-timezone Europe/Amsterdam
date

Install htop to monitor resources:
sudo apt install htop

Install Let's Encrypt certificate for apache and update virtual host file:https://www.linuxcapable.com/how-to-secure-apache-with-lets-encrypt-on-debian-linux/

Install Elasticsearch:
https://www.linuxcapable.com/how-to-install-elasticsearch-8-on-debian-linux/
sudo apt install elasticsearch
Note password for elasticsearch superuser (elastic)!

sudo nano /etc/elasticsearch/elasticsearch.yml
Comment out ssl configs
Locally no ssl certificate is needed (laravel and elasticsearch on same server).
Test elasticsearch nodes:
curl -X GET "localhost:9200/_nodes/stats/jvm?pretty" -u elastic:password
(change password)
Check elasticsearch index:
curl -X GET "localhost:9200/_cat/indices?v=true&s=index" -u elastic:password
(change password)

Update laravel .env with elasticsearch variables and password:
nano .env

ELASTICSEARCH_HOST=localhost:9200
ELASTICSEARCH_USER=elastic
ELASTICSEARCH_PASSWORD=password

Import indexes in elasticsearch:
systemctl stop disable.timebank.cc-queue
systemctl stop dev.timebank.cc-queue
php artisan scout:import
Check the import by running the queue worker manually:
php artisan queue:work
Note that this requires a lot of memory and cpu! Check with htop command.

When all jobs are done start the queue using the systemctl service
systemctl enable dev.timebank.cc-queue
systemctl start dev.timebank.cc-queue
systemctl status dev.timebank.cc-queue

If all runs well, make sure the set restart options in elastic systemd:
sudo nano /usr/lib/systemd/system/elasticsearch.service
Restart=always
RestartSec=60
sudo systemctl daemon-reload
sudo systemctl restart elasticsearch
sudo systemctl status elasticsearch

## Set File Permission on server (Pusher-websocket-server working on server)

Before git clone command in /var/www/:
sudo mkdir timebank_cc_dev
sudo chown -R dev:www-data timebank_cc_dev
sudo -u www-data git clone https://github.com/ronaldhuynen/timebank_cc
cd timebank_cc_dev
sudo -w www-data composer install
sudo -u www-data npm install


Set permissions and ownerships.
See: https://dev.to/imranpollob/mastering-file-and-folder-permissions-in-laravel-applications-4imm
and: https://laraveltuts.com/how-to-set-up-file-permissions-for-laravel-10/

find /var/www/timebank_cc_dev -type d -exec chmod 755 {} \;
find /var/www/timebank_cc_dev -type f -exec chmod 644 {} \;
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chmod -R 755 public
sudo chown www-data:www-data storage
sudo chown www-data:www-data public
sudo chown -R www-data:www-data bootstrap
sudo chown -R www-data:www-data public
sudo chown -R www-data:www-data storage
sudo -u www-data npm run dev



## Setup Laravel Reverb

# Increase nr of open files as each websocket connection will be represented by a file.
sudo nano /etc/security/limits.conf
* soft nofile 4096
* hard nofile 4096
Log out/in to take effect:
sudo su
sudo su dev
ulimit -n

# Reverb will automatically switch to an ext-event, ext-ev, or ext-uv powered loop when available. All of these PHP extensions are available for install via PECL:

sudo nano /etc/php/8.2/cli/php.ini
Add / uncomment under extension:
extension=sockets.so
extension=event.so
sudo nano /etc/php/8.2/apache2/php.ini
Add / uncomment under extension:
extension=sockets.so
extension=event.so
sudo nano /etc/php/8.2/apache2/conf.d/20-sockets.ini
Comment out, so sockets will not be loaded twice:
; extension=sockets.so
sudo nano /etc/php/8.2/cli/conf.d/20-sockets.ini
Comment out, so sockets will not be loaded twice:
; extension=sockets.so
sudo service apache2 restart
Verify if event extension is loaded:
php -i | grep -i "event"


# Allow connections on port 6001:
sudo ufw allow 6001 comment 'accept Websocket connections'


## Create a subdomain ws.timebank.cc for websocket server
https://davidpolanco.com/blog/how-to-add-subdomains-to-apache2-web-server/
sudo nano /etc/apache2/sites-enabled/ws.timebank.cc.conf
<VirtualHost *:80>
        ServerName ws.timebank.cc
        ServerAlias ws.timebank.cc
        ServerAdmin admin@timebank.cc

        DocumentRoot /var/www/ws.timebank.cc/public
        DirectoryIndex index.php index.html index.htm

        <Directory /var/www/ws.timebank.cc/public/>
            Require all granted
            Options Indexes FollowSymLinks MultiViews
            AllowOverride all
            Order allow,deny
            allow from all
            Require all granted
        </Directory>

        Alias /log/ "/var/log/"
        <Directory "/var/log/">
            Options Indexes MultiViews FollowSymLinks
            AllowOverride None
            Order deny,allow
            Deny from all
            Allow from all
            Require all granted
        </Directory>

RewriteEngine on
RewriteCond %{SERVER_NAME} =ws.timebank.cc
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
sudo systemctl restart apache2


# Get a certificate from Letsencrypt
https://www.digitalocean.com/community/tutorials/how-to-set-up-let-s-encrypt-certificates-for-multiple-apache-virtual-hosts-on-ubuntu-14-04
sudo certbot --apache -d ws.timebank.cc

# Update Apache Virtual Host for wss://ws.timebank.cc
sudo nano /etc/apache2/sites-enabled/ws.timebank.cc.conf

<VirtualHost *:443>

        ServerName ws.timebank.cc
        ServerAlias ws.timebank.cc
        ServerAdmin admin@timebank.cc

        ProxyPreserveHost On
        ProxyRequests Off

        # Handle WebSocket connections in Laravel
        ProxyPass "/app" "wss://localhost:6001/app"
        ProxyPassReverse "/app" "wss://localhost:6001/app"

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        SSLEngine on
        SSLCertificateFile      /etc/letsencrypt/live/ws.timebank.cc/fullchain.pem
        SSLCertificateKeyFile   /etc/letsencrypt/live/ws.timebank.cc/privkey.pem

</VirtualHost>
sudo systemctl restart apache2


# Setup Reverb websocket server
 sudo -u www-data nano /var/www/timebank_cc_dev/config/reverb.php 


'reverb' => [
            'host' => env('REVERB_SERVER_HOST', '0.0.0.0'),
            'port' => env('REVERB_SERVER_PORT', 8080),
            'hostname' => env('REVERB_HOST'),
            'options' => [
                'tls' => [
                        'local_cert' => '/etc/letsencrypt/live/ws.timebank.cc/fullchain.pe>
                        'local_pk' => '/etc/letsencrypt/live/ws.timebank.cc/privkey.pem', >
                        'verify_peer' => false,
                        ],
            ],
....


Compile assets after editing:
sudo www-data npm run dev

# Test wss websocket connection:
Note that we must start the reverb server as root, because it should be able to access the certificates!
sudo -u root php artisan reverb:start --port=6001 --debug
sudo echo | openssl s_client -connect ws.timebank.cc:6001

# Create a systemd service for the Reverb server:
sudo nano ws.timebank.cc-websockets.service

----


[Unit]
Description=Laravel Websockets Server

[Service]
ExecStart=/usr/bin/php artisan reverb:start --port=6001
WorkingDirectory=/var/www/timebank_cc_dev
User=root
Group=root
Restart=always
RestartSec=3
SyslogIdentifier=timebank.cc-websockets
LimitNOFILE=10000

[Install]
WantedBy=multi-user.target

----
sudo systemctl daemon-reload
sudo systemctl enable ws.timebank.cc-websockets.service
sudo systemctl start ws.timebank.cc-websockets.service
sudo systemctl status ws.timebank.cc-websockets.service
And test the messenger and the profile switch event in Laravel





