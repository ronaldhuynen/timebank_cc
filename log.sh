#!/bin/bash
# Display last 100 lines of the log file and append when new lines are added
# Usage: ./log.sh

# WARNING: This script is for development purposes only. 
# Do include in production folder, unless execution rights are restricted. See below.

# Change the ownership of the file to your user:
# chown user:user log.sh

# Set the permissions to allow only the owner to read and execute the file:
# sudo chmod 700 log.sh

tail -n 100 -f storage/logs/laravel.log