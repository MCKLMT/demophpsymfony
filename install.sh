#!/bin/bash

# Install Symfony CLI
curl -sS https://get.symfony.com/cli/installer | bash
mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install Git
apt-get install git -y

# Add dependencies
php composer.phar install --no-dev --optimize-autoloader
php composer.phar dump-env staging

# Configure application
APP_ENV = prod
APP_DEBUG = 0

# Clear cache
php bin/console cache:clear