#!/bin/bash

# Start Laravel development server
echo "Starting Laravel development server..."
php artisan serve &

# Give Laravel some time to start
sleep 5

# Open a new terminal and start Vite development server
echo "Starting Vite development server in a new terminal..."

# For Windows (using Git Bash or WSL):
# Use `start` to open a new terminal window and execute the command
cmd.exe /c start "Vite" /k "npm run dev"

# For Linux:
# gnome-terminal -- npm run dev

# For macOS:
# osascript -e 'tell app "Terminal" to do script "npm run dev"'
