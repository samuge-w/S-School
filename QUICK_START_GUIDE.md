# Quick Start Guide - Beira Unida School Management System

## For the School (Beira Unida)

### First-Time Access

1. **Access the System**
   - Visit: `https://your-subdomain.com`
   - Username: (provided by administrator)
   - Password: (provided by administrator)

2. **Change Password**
   - Click your name (top right)
   - Select "Profile"
   - Update password
   - Save

3. **Activate License**
   - Click your name → "License Settings"
   - Enter the license key provided
   - Click "Activate"
   - Verify expiration date

4. **Switch Language**
   - Click your name → Select 🇬🇧 EN or 🇵🇹 PT
   - Your preference is saved

### Daily Operations

**Adding a Student:**
1. Students → Add Student
2. ID auto-generates (BCBA-2025-XXXX)
3. Fill student information
4. Assign Family ID (for siblings)
5. Select Curriculum (Ambleside/Cambridge/Nacional)
6. Choose Class/Grade
7. Save

**Recording Attendance:**
1. Attendance → Mark Attendance
2. Select Class & Date
3. Mark Present/Absent
4. Save

**Fee Collection:**
1. Fees → Fee Collection
2. Search student or family
3. Enter amount received
4. Select payment method
5. Save & Print receipt

**Generating Reports:**
1. Reports → Select report type
2. Choose filters (class, date, etc.)
3. Generate
4. Print or Export

---

## For You (The Provider)

### License Management

**Generate License Keys:**

```php
// Via License Settings (as Director):
1. Login with Director account
2. Profile → License Settings
3. Scroll to "Generate License"
4. Select type: monthly/yearly/2year/lifetime
5. Add notes (optional)
6. Generate
7. Copy and send to school
```

**License Types:**
- `monthly` - 30 days
- `yearly` - 12 months  
- `2year` - 24 months
- `lifetime` - No expiration

### Updating the System

**Via Git (Recommended):**

```bash
# On the server
cd /path/to/beira-unida
git pull origin main
./deploy.sh
```

**Manual Updates:**

```bash
php artisan down
# Upload files
composer install
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up
```

### Monitoring

**Check License Status:**
- Login as Director
- License Settings
- View expiration date

**Database Backups:**
- Set up automated daily backups
- Store in multiple locations
- Test restore procedure monthly

**Error Monitoring:**
- Check `storage/logs/laravel.log`
- Monitor via cPanel error logs
- Set up email alerts for critical errors

### Subscription Control

You have full control:
1. Generate licenses
2. Set expiration dates
3. Monitor usage
4. Suspend/reactivate licenses
5. Track multiple schools (via school_id)

### Getting Paid

**Workflow:**
1. School contacts for renewal
2. Invoice for subscription
3. Upon payment confirmation
4. Generate and send new license key
5. School activates on their end
6. Verify activation

**Pricing Suggestions:**
- Monthly: $50-100 USD
- Yearly: $500-1000 USD (2 months free)
- 2-Year: $900-1800 USD (4 months free)
- Lifetime: $3000-5000 USD (one-time)

*(Adjust based on your costs and market)*

---

## Common Tasks

### Upload School Logo

**Method 1 - File Manager:**
```
cPanel → File Manager
Navigate to: /public/assets/images/schools/
Upload: beira-unida-logo.png
```

**Method 2 - Institute Settings:**
```
Settings → Institute
Click logo upload
Select file
Save
```

### Update School Information

```
Settings → Institute
Edit bilingual fields:
- Name (EN/PT)
- Vision (EN/PT)
- Mission (EN/PT)  
- Motto (EN/PT)
- Contact details
Save
```

### Add New Curriculum

```sql
-- In database
INSERT INTO curriculums (name, description, is_active) 
VALUES ('New Curriculum', 'Description', 1);

-- Add subjects
INSERT INTO curriculum_subjects (curriculum_id, subject_name, grade_levels)
VALUES (4, 'Subject Name', '["Grade1", "Grade2"]');
```

---

## Troubleshooting

### Issue: "License Expired"
**Solution:** Generate new license, send to school

### Issue: "Student ID not generating"
**Check:**
```php
// Verify in StudentController
use App\Services\StudentIdGenerator;
$regiNo = StudentIdGenerator::generate();
```

### Issue: "Language not switching"
**Clear cache:**
```bash
php artisan cache:clear
php artisan view:clear
```

### Issue: "Logo not showing"
**Check:**
1. File exists: `/public/assets/images/schools/beira-unida-logo.png`
2. File permissions: `chmod 644`
3. File size: < 500KB
4. Format: PNG

---

## Performance Optimization

```bash
# Production optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Enable OPcache in PHP
# Enable MySQL query cache
# Use CDN for static assets
```

---

## Security Checklist

- [ ] .env file not in Git
- [ ] Strong database password
- [ ] HTTPS/SSL enabled
- [ ] Regular backups automated
- [ ] Update Laravel regularly
- [ ] Monitor error logs
- [ ] File permissions correct (775 for storage)
- [ ] Disable debug mode in production

---

## Support Contacts

**School Support:**
Email: director@beiraunida.com  
Phone: (+258) 85 220 3932

**Technical Provider:**
[Your contact information]

---

## File Locations Reference

```
Important Files:
├── .env                          # Configuration (DON'T SHARE)
├── public/
│   └── assets/images/schools/    # School logos
├── database/
│   ├── migrations/               # Database structure
│   └── seeders/
│       └── BeiraUnidaSeeder.php  # School data
├── resources/
│   ├── lang/                     # Translations
│   └── views/
│       └── app/
│           └── license_settings.blade.php
├── app/
│   ├── Models/
│   │   └── License.php           # License logic
│   ├── Services/
│   │   └── StudentIdGenerator.php
│   └── Http/
│       ├── Controllers/
│       │   ├── LicenseController.php
│       │   ├── LanguageController.php
│       │   └── CurriculumController.php
│       └── Middleware/
│           └── CheckLicense.php
└── storage/
    └── logs/
        └── laravel.log           # Error logs
```

---

## Quick Commands Reference

```bash
# Start system
php artisan serve

# Maintenance mode
php artisan down
php artisan up

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate
php artisan migrate:rollback

# Seed data
php artisan db:seed --class=BeiraUnidaSeeder

# Generate key
php artisan key:generate

# Create storage link
php artisan storage:link
```

---

**System Status:** ✅ Ready for Production

**Next Step:** Follow DEPLOYMENT_GUIDE.md to deploy to server

**Questions?** Read BEIRA_UNIDA_README.md or IMPLEMENTATION_SUMMARY.md




