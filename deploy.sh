#!/bin/sh

# Pull from master
git pull origin master

# Install dependencies
composer install --no-interaction --no-dev --prefer-dist

# Migrate
php artisan migrate --force

# Change assets version to break browser cache
php artisan assets:version

# Clear view cache
php artisan view:clear

# Destroy application cache to allow for structural changes
php artisan cache:clear