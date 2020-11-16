#!/bin/bash

# Install Symfony CLI
curl -sS https://get.symfony.com/cli/installer | bash
mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install Git
apt-get install git -y