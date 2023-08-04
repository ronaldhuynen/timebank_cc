#!/bin/bash
{
    php artisan serve
}& 
{  
    php artisan websockets:serve
}&
    php artisan queue:work

