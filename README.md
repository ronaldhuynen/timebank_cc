<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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



