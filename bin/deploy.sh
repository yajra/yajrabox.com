#!/bin/bash

if [ ! -f composer.json ]; then
    echo "Please make sure to run this script from the root directory of this repo."
    exit 1
fi

git pull
composer install
php artisan optimize
php artisan sitemap:generate
npm ci
npm run build
source "$(dirname "$0")/checkout_latest_docs.sh"
