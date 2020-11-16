# Add dependencies
php composer.phar install --no-dev --optimize-autoloader
php composer.phar dump-env staging

# Configure application
APP_ENV=prod
APP_DEBUG=0

# Clear cache
php bin/console cache:clear