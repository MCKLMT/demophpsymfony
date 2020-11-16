#!/bin/bash

echo '......................'

# Add dependencies
echo '### php composer.phar dump-env staging ###'
php composer.phar dump-env staging

# Configure application
APP_ENV=prod
APP_DEBUG=0

# Clear cache
php bin/console cache:clear