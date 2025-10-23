# Local Testing Guide - Beira Unida School System

## Prerequisites Check

Before starting, ensure you have:
- ✅ PHP 8.2+ installed
- ✅ Composer installed
- ✅ MySQL/MariaDB running
- ✅ Git installed

## Step-by-Step Local Setup

### 1. Create Local Database

Open MySQL and create a test database:

```sql
CREATE DATABASE beira_unida_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'beira_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON beira_unida_test.* TO 'beira_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Configure Environment

Copy the environment template:

```bash
# In your project directory
copy ENV_TEMPLATE.md .env
```

Edit `.env` file with these settings:

```env
APP_NAME="Beira United Christian Academy"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=Africa/Maputo
APP_URL=http://localhost:8080
APP_LOCALE=en

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=beira_unida_test
DB_USERNAME=beira_user
DB_PASSWORD=your_password

# Cache & Session (use file for local testing)
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Mail (use log for testing - emails go to storage/logs)
MAIL_MAILER=log

# OTP
OTP=No
```

### 3. Install Dependencies & Setup

Run these commands in order:

```bash
# Install PHP dependencies
composer install

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed Beira Unida data (school info, curricula, subjects)
php artisan db:seed --class=BeiraUnidaSeeder

# Create storage symbolic link
php artisan storage:link

# Install Passport for API authentication
php artisan passport:install

# Clear all caches (good practice)
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 4. Start Local Server

Since port 10000 is taken, let's use port 8080:

```bash
php artisan serve --port=8080
```

You should see:
```
INFO  Server running on [http://127.0.0.1:8080]
```

**Access the system at:** `http://localhost:8080`

### 5. First Login

Default credentials will depend on what's seeded. If none exist, create one:

```bash
php artisan tinker
```

Then in tinker:
```php
$user = new App\Models\User();
$user->name = "Director Test";
$user->email = "director@test.com";
$user->password = bcrypt("password123");
$user->group = "Director";
$user->group_id = 1;
$user->save();
exit
```

Login with:
- **Email:** director@test.com
- **Password:** password123

---

## 🧪 Testing Checklist

### Test 1: Basic Access ✓
- [ ] Can access http://localhost:8080
- [ ] Login page displays
- [ ] School logo appears (or placeholder)
- [ ] Can login successfully

### Test 2: License System ✓
- [ ] Navigate to Profile → License Settings
- [ ] Generate a test license key
- [ ] Copy the generated key
- [ ] Activate the key
- [ ] Verify expiration date shows

### Test 3: Language Switcher ✓
- [ ] Click Profile menu
- [ ] See language buttons (🇬🇧 EN / 🇵🇹 PT)
- [ ] Switch to Portuguese
- [ ] Verify interface changes to Portuguese
- [ ] Switch back to English
- [ ] Preference persists after logout/login

### Test 4: Student Management ✓
- [ ] Go to Students → Add Student
- [ ] Verify Student ID auto-generates (BCBA-2025-XXXX)
- [ ] Fill in student information
- [ ] Select a Family ID
- [ ] Choose Curriculum (Ambleside/Cambridge/Nacional)
- [ ] Select Grade
- [ ] Save student
- [ ] Verify student appears in list

### Test 5: Curriculum System ✓
- [ ] View seeded curricula in database
- [ ] Verify 3 curricula exist
- [ ] Check curriculum has subjects
- [ ] Test curriculum selection in student form

### Test 6: School Information ✓
- [ ] Navigate to Settings → Institute
- [ ] Verify Beira Unida information is pre-populated
- [ ] Check bilingual fields (EN/PT)
- [ ] Verify contact information
- [ ] Check Vision/Mission statements

### Test 7: UI & Design ✓
- [ ] Check if custom CSS is loaded
- [ ] Verify modern, light theme
- [ ] Test responsive design (resize browser)
- [ ] Check buttons have rounded corners
- [ ] Verify smooth transitions on hover

---

## 🔍 Troubleshooting Local Testing

### Issue: "No application encryption key"
```bash
php artisan key:generate
```

### Issue: "Access denied for user"
Check your .env database credentials match what you created in MySQL.

### Issue: "Class not found"
```bash
composer dump-autoload
php artisan clear-compiled
```

### Issue: "Migration table not found"
```bash
php artisan migrate:fresh
php artisan db:seed --class=BeiraUnidaSeeder
```

### Issue: "Storage link already exists"
Delete the existing link and recreate:
```bash
# Windows
rmdir public\storage
php artisan storage:link
```

### Issue: Custom CSS not loading
```bash
php artisan view:clear
# Then hard refresh browser (Ctrl+Shift+R)
```

### Issue: Port 8080 already in use
Try a different port:
```bash
php artisan serve --port=8081
# or
php artisan serve --port=9000
```

---

## 📊 Database Verification

Check if data was seeded correctly:

```bash
php artisan tinker
```

```php
// Check curricula
\App\Models\Curriculum::count(); // Should be 3

// Check curriculum subjects
\App\Models\CurriculumSubject::count(); // Should be 38

// Check classes/grades
\App\Models\ClassModel::count(); // Should be 7

// Check institute info
$institute = \App\Models\Institute::first();
echo $institute->name; // Should show Beira Unida

exit
```

---

## 🎯 Testing License Keys

### Generate Different License Types

1. **Monthly License:**
   - Generate with type: "monthly"
   - Should expire in 30 days from activation

2. **Yearly License:**
   - Generate with type: "yearly"
   - Should expire in 365 days from activation

3. **2-Year License:**
   - Generate with type: "2year"
   - Should expire in 730 days from activation

4. **Lifetime License:**
   - Generate with type: "lifetime"
   - Should show "Lifetime" for expiry

### Testing License Expiration

To test expiration warnings, you can manually update a license in the database:

```bash
php artisan tinker
```

```php
// Get the active license
$license = \App\Models\License::where('status', 'active')->first();

// Set expiry to 20 days from now (should trigger warning)
$license->expiry_date = now()->addDays(20);
$license->save();

// Reload the dashboard - you should see a warning
exit
```

---

## 🔐 Security Testing

### Test License Middleware

1. Try accessing a protected page without a license
2. Should redirect to license settings
3. Activate a license
4. Should now access the page

### Test Language Persistence

1. Switch to Portuguese
2. Logout
3. Login again
4. Language should still be Portuguese

---

## 📝 Sample Test Data

### Sample Student

```
Student ID: BCBA-2025-0001 (auto-generated)
First Name: João
Last Name: Silva
Middle Name: Pedro
Gender: Male
Date of Birth: 2010-05-15
Nationality: Mozambican
Class: 7ª^8ª
Curriculum: Cambridge
Family ID: FAM-2025-001
Guardian Name: Maria Silva
Guardian Contact: (+258) 84 123 4567
Church: Igreja Beira
Present Address: Bairro da Manga, Beira
```

### Sample Family (for testing family billing)

```
Family ID: FAM-2025-001

Student 1: João Silva (BCBA-2025-0001)
Student 2: Ana Silva (BCBA-2025-0002)

Both should appear together in family invoice.
```

---

## ✅ Pre-Deployment Checklist

Before approving deployment, verify:

- [ ] All migrations run successfully
- [ ] Seeder populated all data correctly
- [ ] License generation and activation works
- [ ] Language switching works in both directions
- [ ] Student ID auto-generation works
- [ ] Curriculum selection works
- [ ] School information displays correctly
- [ ] Custom CSS loads properly
- [ ] No PHP errors in logs
- [ ] Database structure is correct

---

## 📂 Log Files Location

If you encounter errors, check:

```
storage/logs/laravel.log
```

View latest log entries:
```bash
# Windows
type storage\logs\laravel.log | more

# Or open in notepad
notepad storage\logs\laravel.log
```

---

## 🎓 Next Steps After Local Testing

Once everything works locally:

1. ✅ Mark all checklist items above
2. ✅ Review license key explanation
3. ✅ Approve deployment
4. 🚀 Deploy to production server

---

**Local Testing Port:** http://localhost:8080  
**Database:** beira_unida_test  
**Environment:** local (debug mode ON)

**Note:** This is a safe testing environment. Any data you create here won't affect production.




