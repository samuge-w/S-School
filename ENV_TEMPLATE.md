# Environment Configuration Template

Create a `.env` file in the root directory with the following content:

```env
APP_NAME="Beira United Christian Academy"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=Africa/Maputo
APP_URL=http://localhost
APP_LOCALE=en

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=beira_unida_school
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_CONNECTION=log
CACHE_STORE=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="director@beiraunida.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

# OTP Settings
OTP=No
```

## After Creating .env File

1. Generate application key:
   ```bash
   php artisan key:generate
   ```

2. Run migrations:
   ```bash
   php artisan migrate
   ```

3. Seed the database with Beira Unida information:
   ```bash
   php artisan db:seed --class=BeiraUnidaSeeder
   ```

4. Create storage link:
   ```bash
   php artisan storage:link
   ```

5. Install Passport (for API authentication):
   ```bash
   php artisan passport:install
   ```




