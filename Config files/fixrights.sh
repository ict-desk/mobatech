#!/bin/bash

SITEPATH="/var/www/sites/mobatech"

echo "Fix ownership..."
sudo chown -R www-data:www-data $SITEPATH

echo "Fix folder permissions..."
sudo find $SITEPATH -type d -exec chmod 755 {} \;

echo "Fix file permissions..."
sudo find $SITEPATH -type f -exec chmod 644 {} \;

echo "Laravel writable folders..."
sudo chmod -R 775 $SITEPATH/storage
sudo chmod -R 775 $SITEPATH/bootstrap/cache

echo "SQLite database permissions..."

sudo chmod 664 $SITEPATH/database/database.sqlite
sudo chown www-data:www-data $SITEPATH/database/database.sqlite

sudo chmod 775 $SITEPATH/database
sudo chown www-data:www-data $SITEPATH/database

echo "Done!"