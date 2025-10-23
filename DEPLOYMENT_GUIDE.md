# Deployment Guide - Beira Unida School Management System

## Git-Based Deployment to cPanel

### Prerequisites
- cPanel hosting account with SSH access
- Git installed on the server
- PHP 8.2 or higher
- MySQL database
- Composer installed

---

## Initial Setup

### 1. Create a Git Repository

On your local machine or development server:

```bash
cd /path/to/S-School-main
git init
git add .
git commit -m "Initial commit - Beira Unida customization"
```

### 2. Create Remote Repository

Create a private repository on GitHub, GitLab, or Bitbucket:
- Repository name: `beira-unida-school`
- Visibility: Private

Add remote and push:

```bash
git remote add origin https://github.com/yourusername/beira-unida-school.git
git branch -M main
git push -u origin main
```

---

## cPanel Deployment

### Method 1: Using cPanel Terminal (Recommended)

1. **Access cPanel Terminal**
   - Log in to your cPanel account
   - Navigate to "Terminal" under Advanced section

2. **Navigate to public_html or subdomain directory**
   ```bash
   cd public_html/beira-unida
   # or for subdomain:
   cd public_html/subdomain_name
   ```

3. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/beira-unida-school.git .
   ```

4. **Set up environment file**
   ```bash
   cp ENV_TEMPLATE.md .env
   nano .env  # Edit with your database credentials
   ```

5. **Install dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Run migrations and seed data**
   ```bash
   php artisan migrate
   php artisan db:seed --class=BeiraUnidaSeeder
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Install Passport (for API)**
   ```bash
   php artisan passport:install
   ```

10. **Set permissions**
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

11. **Optimize for production**
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

### Method 2: Using SSH

If you have SSH access:

```bash
ssh username@your-server.com
cd /home/username/public_html/beira-unida
git clone https://github.com/yourusername/beira-unida-school.git .
# Follow steps 4-11 from Method 1
```

---

## Updating the Application

### For Future Updates (Git Pull Method)

1. **SSH or Terminal access**
   ```bash
   cd /path/to/beira-unida
   ```

2. **Put site in maintenance mode**
   ```bash
   php artisan down
   ```

3. **Pull latest changes**
   ```bash
   git pull origin main
   ```

4. **Run deployment script**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```
   
   Or manually:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan cache:clear
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan up
   ```

---

## Subdomain Setup in cPanel

1. **Create Subdomain**
   - Go to cPanel → Domains → Subdomains
   - Enter subdomain name: `beiraunida` or `school`
   - Document root: `/public_html/beiraunida`
   - Click "Create"

2. **Point to Laravel public directory**
   
   Edit `.htaccess` in subdomain root:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```

   Or configure subdomain to point directly to `/public` folder

---

## Database Configuration

### Create Database in cPanel

1. Go to cPanel → MySQL Databases
2. Create new database: `username_beira_unida`
3. Create new user: `username_beira_user`
4. Add user to database with ALL PRIVILEGES
5. Update `.env` file with credentials:
   ```env
   DB_DATABASE=username_beira_unida
   DB_USERNAME=username_beira_user
   DB_PASSWORD=your_secure_password
   ```

---

## Post-Deployment Checklist

- [ ] .env file configured correctly
- [ ] Database created and credentials set
- [ ] Migrations run successfully
- [ ] BeiraUnidaSeeder executed
- [ ] Storage link created
- [ ] Permissions set correctly (775 for storage/bootstrap)
- [ ] Caches cleared and regenerated
- [ ] Website accessible via browser
- [ ] License key generated and activated
- [ ] School logo uploaded to `/public/assets/images/schools/`
- [ ] Test login functionality
- [ ] Test language switcher (EN/PT)
- [ ] Verify student enrollment with auto-ID generation
- [ ] Test curriculum selection

---

## Troubleshooting

### Common Issues

**Issue: 500 Internal Server Error**
- Check file permissions (storage and bootstrap/cache should be 775)
- Verify .env file exists and is configured
- Check error logs: `storage/logs/laravel.log`

**Issue: Database connection error**
- Verify database credentials in .env
- Ensure database user has correct privileges
- Check if database exists

**Issue: Missing dependencies**
```bash
composer install
```

**Issue: Cache problems**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

**Issue: Vendor folder missing**
- Run `composer install` via terminal

---

## Backup Procedures

### Before Any Update

1. **Backup database**
   ```bash
   php artisan db:backup  # If backup package installed
   ```
   
   Or via cPanel → phpMyAdmin → Export

2. **Backup files**
   ```bash
   tar -czf backup-$(date +%Y%m%d).tar.gz .
   ```

3. **Download backup** to your local machine

---

## Security Recommendations

1. **Keep .env file secure** - Never commit to Git
2. **Use strong database passwords**
3. **Enable HTTPS/SSL** via cPanel
4. **Regular backups** (daily recommended)
5. **Keep Laravel and dependencies updated**
6. **Monitor error logs regularly**

---

## Support Contacts

**School Contact:**
- Email: director@beiraunida.com
- Phone: (+258) 85 220 3932

**System Provider:**
- [Your contact information]

---

## License Key Management

After deployment, generate and activate a license:

1. Log in as Director/Admin
2. Navigate to Profile menu → License Settings
3. Generate a new license (choose type: monthly/yearly/2year/lifetime)
4. Copy the generated key
5. Enter and activate the license
6. Verify expiration date

The system will display warnings 30 days before expiration.




