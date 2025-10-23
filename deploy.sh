#!/bin/bash

# Beira Unida School Management System
# Deployment Script
# This script handles post-deployment tasks

echo "🚀 Starting deployment for Beira Unida School Management System..."

# Set maintenance mode
php artisan down --message="System is being updated. Please wait a moment." --retry=60

# Pull latest changes (if using Git)
# git pull origin main

# Install/update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Clear caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Cache configurations for better performance
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    echo "🔗 Creating storage link..."
    php artisan storage:link
fi

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Bring application back online
php artisan up

echo "✅ Deployment completed successfully!"
echo "🎓 Beira United Christian Academy / Colégio Cristão Beira Unida"




