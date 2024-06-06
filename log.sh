#!/bin/bash
# WARNING: This script is for development purposes only. 
# Do include in production folder, unless execution rights are restricted. See below.

# Change the ownership of the file to your user:
# chown user:user log.sh

# Set the permissions to allow only the owner to read and execute the file:
# sudo chmod 700 log.sh

# Ask for the number of lines to display
echo "How many lines of the log would you like to display?"
read num_lines

# Display the specified number of lines from the log
tail -n $num_lines storage/logs/laravel.log

# Ask if the log should be cleared
echo "Would you like to clear the log? (Y/N)"
read clear_log

# Clear the log if the user answered 'Y' or 'y'
if [ "$clear_log" = "Y" ] || [ "$clear_log" = "y" ]; then
    > storage/logs/laravel.log
    echo ""
    echo "Log cleared."
    echo ""

    
    # Clear the log and append the date and time it was cleared
    echo "" > storage/logs/laravel.log
    echo "[ Log cleared at: $(date) ]" >> storage/logs/laravel.log
    echo "" >> storage/logs/laravel.log

fi

# Exit the script
exit 0