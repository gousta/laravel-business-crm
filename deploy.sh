#!/bin/sh

# Reset if changes happened on the server
git reset --hard

# Pull from master
git pull origin master

# Install dependencies
composer install --no-interaction --no-dev --prefer-dist

# Migrate
php artisan migrate --force

# Change assets version to break browser cache
php artisan assets:version