#!/bin/bash

# |--------------------------------------------------------------------------
# | Dev Mobatech deploy script
# |--------------------------------------------------------------------------
# | React/Laravel deploy helper for Caddy + PHP-FPM.
# | Run from project root: /var/www/sites/dev-mobatech
# |--------------------------------------------------------------------------
 
set -e

SITE_PATH="/var/www/sites/dev-mobatech"
PHP_FPM_SOCKET="/run/php/php8.5-fpm.sock"

echo "Starting deploy for dev-mobatech..."

cd "$SITE_PATH"

echo "Setting owner..."
sudo chown -R www-data:www-data "$SITE_PATH"

echo "Setting folder permissions..."
sudo find "$SITE_PATH" -type d -exec chmod 755 {} \;

echo "Setting file permissions..."
sudo find "$SITE_PATH" -type f -exec chmod 644 {} \;

echo "Setting writable Laravel folders..."
sudo chmod -R 775 "$SITE_PATH/storage"
sudo chmod -R 775 "$SITE_PATH/bootstrap/cache"

echo "Clearing Laravel cache..."
sudo -u www-data php artisan config:clear
sudo -u www-data php artisan route:clear
sudo -u www-data php artisan view:clear
sudo -u www-data php artisan cache:clear

echo "Caching Laravel config..."
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache

echo "Reloading Caddy..."
sudo systemctl reload caddy

echo "Deploy done."