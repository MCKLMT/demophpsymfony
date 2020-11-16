#!/bin/bash
echo '......................'

echo '### Composer Install ###'
php composer.phar install --no-dev --optimize-autoloader

# Add dependencies
echo '### Dumping Env ###'
php composer.phar dump-env staging

echo '### Set Environment variables ###'
# Configure application
APP_ENV=prod
APP_DEBUG=0

echo '### Clear cache ###'
# Clear cache
php bin/console cache:clear

echo '......................'