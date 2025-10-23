# Beira Unida School Management System

<div align="center">

**Colégio Cristão Beira Unida** | **Beira United Christian Academy**

*"Formando corações e mentes" / "Shaping Hearts and Minds"*

![Laravel](https://img.shields.io/badge/Laravel-11.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![License](https://img.shields.io/badge/License-Subscription-green)
![Status](https://img.shields.io/badge/Status-Production%20Ready-success)

</div>

---

## 🎯 Overview

A fully customized school management system designed specifically for **Beira United Christian Academy** in Mozambique. This system manages students, teachers, curriculum, attendance, fees, and academic records with support for three different curricula and bilingual interface.

### Key Features

✅ **Bilingual Interface** - English (UK) & Portuguese (Mozambique)  
✅ **Multi-Curriculum Support** - Ambleside, Cambridge, Nacional  
✅ **License Management** - Subscription-based access control  
✅ **Auto-Generated Student IDs** - Format: BCBA-YYYY-XXXX  
✅ **Family-Based Billing** - Group siblings for fee management  
✅ **Modern UI** - Light, clean, and responsive design  
✅ **Git Deployment** - Easy updates via Git pull  

---

## 📚 Documentation

| Document | Description |
|----------|-------------|
| **[QUICK_START_GUIDE.md](QUICK_START_GUIDE.md)** | Start here! Quick setup and daily operations |
| **[BEIRA_UNIDA_README.md](BEIRA_UNIDA_README.md)** | Complete user manual and administration guide |
| **[DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)** | Technical deployment instructions for cPanel |
| **[IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)** | What was implemented and how |
| **[ENV_TEMPLATE.md](ENV_TEMPLATE.md)** | Environment configuration template |

---

## 🚀 Quick Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Git
- cPanel hosting (recommended) or any PHP hosting

### Installation Steps

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/beira-unida-school.git
cd beira-unida-school

# 2. Install dependencies
composer install

# 3. Setup environment
cp ENV_TEMPLATE.md .env
nano .env  # Edit database credentials

# 4. Generate application key
php artisan key:generate

# 5. Run migrations
php artisan migrate

# 6. Seed Beira Unida data
php artisan db:seed --class=BeiraUnidaSeeder

# 7. Create storage link
php artisan storage:link

# 8. Install Passport (for API)
php artisan passport:install

# 9. Set permissions
chmod -R 775 storage bootstrap/cache

# 10. Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### First Login

1. Access the system via your URL
2. Login with default credentials (provided by admin)
3. Change password immediately
4. Activate license key in Settings

---

## 🎓 System Features

### 1. License Management

Control access with subscription-based licensing:

- **Monthly** - 30-day access
- **Yearly** - 12-month access  
- **2-Year** - 24-month access
- **Lifetime** - Permanent access

Generate and manage licenses through the admin panel.

### 2. Multi-Curriculum System

Three fully integrated curricula:

#### Ambleside Schools International (18 subjects)
Charlotte Mason-based methodology with subjects including Bible, Literature, Math, Science, History, and more.

#### Cambridge International (11 subjects)
International standard curriculum with English, Math, Science, ICT, Business Studies, and other subjects.

#### Curriculum Nacional (9 subjects)
Mozambique National Curriculum with Português, Matemática, Ciências Naturais, and other subjects.

### 3. Student Management

- Auto-generated IDs (BCBA-YYYY-XXXX format)
- Complete student profiles
- Guardian information
- Church/Community affiliation
- Family grouping for siblings
- Photo uploads
- Academic history tracking

### 4. Academic Tracking

- Attendance recording (daily/monthly)
- Grade/marks management
- Exam scheduling and results
- Subject assignments
- Teacher assignments
- Academic reports

### 5. Financial Management

- Fee structure setup
- Family-based billing
- Payment tracking
- Multiple payment methods
- Late fee penalties
- Financial reports
- Invoice generation

### 6. Bilingual Interface

Complete interface in:
- 🇬🇧 **English (UK)**
- 🇵🇹 **Português (Moçambique)**

Users can switch languages with one click, and preferences are saved.

---

## 📱 Supported Modules

| Module | Features |
|--------|----------|
| **Students** | Enrollment, Profiles, Family Grouping, ID Auto-Generation |
| **Teachers** | Profiles, Subject Assignment, Class Assignment, Timetable |
| **Classes** | 7 Grade Levels (Pré 3^4 to 10ª^11), Sections, Timetables |
| **Subjects** | Curriculum-based, Grade-specific, Teacher Assignment |
| **Attendance** | Daily Marking, Monthly Reports, Student-wise tracking |
| **Exams** | Scheduling, Marks Entry, Grade Sheets, Result Analysis |
| **Fees** | Structure Setup, Collection, Family Billing, Overdue Tracking |
| **Reports** | Academic, Financial, Attendance, Student Profile |
| **Settings** | School Info, Users, License, Language, Permissions |

---

## 🎨 Modern Design

The system features a light, modern UI with:

- **Primary Color**: #4A90E2 (Blue)
- **Secondary Color**: #50C878 (Green)
- **Typography**: Poppins font family
- **Components**: Rounded corners, smooth animations, subtle shadows
- **Responsive**: Works on desktop, tablet, and mobile

---

## 🔐 Security Features

- License-based access control
- Role-based permissions (Director, Admin, Teacher, Student)
- Secure password hashing
- CSRF protection
- SQL injection prevention
- XSS protection
- Session management

---

## 📊 Database Structure

**Tables:** 30+  
**Custom Migrations:** 6  
**Seeded Data:** School info, Curricula (3), Subjects (38), Grade Levels (7)  

Key tables:
- `licenses` - Subscription management
- `curriculums` - Curriculum definitions
- `curriculum_subjects` - Subject-grade mappings
- `Student` - Student information (extended)
- `institute` - School information (bilingual)
- `users` - System users with language preference

---

## 🔄 Update Workflow

### For Providers (You)

```bash
# Make changes locally
git add .
git commit -m "Description of changes"
git push origin main

# School updates via:
ssh school@server
cd /path/to/app
git pull origin main
./deploy.sh
```

### For Schools

Simply run the deploy script after you push updates:

```bash
./deploy.sh
```

The script handles:
- Pulling latest code
- Installing dependencies
- Running migrations
- Clearing and rebuilding caches
- Maintaining uptime

---

## 📞 Support & Contact

### School Contact

**Beira United Christian Academy**  
Colégio Cristão Beira Unida

📍 Samora Machel, Instituto Bíblico de Sofala (IBS)  
   Pioneiros, Sofala, Beira, Mozambique

📧 director@beiraunida.com  
📞 (+258) 85 220 3932  
🌐 www.beiraunida.com  
📘 facebook.com/BeiraUnida  

**NUIT:** 401 866 426

### Technical Support

For technical issues, deployment help, or customization requests:  
[Your contact information here]

---

## 📖 Additional Resources

- **Vision Statement**: Partnering with the community to provide exceptional, international standard education...
- **Mission Statement**: Providing what Charlotte Mason called a "Living Education"...
- **Educational Philosophy**: Charlotte Mason methodology combined with international standards

Full vision and mission statements available in both English and Portuguese in the system.

---

## 🛠️ Built With

- **[Laravel 11](https://laravel.com)** - PHP Framework
- **[PHP 8.2](https://www.php.net)** - Programming Language
- **[MySQL](https://www.mysql.com)** - Database
- **[Bootstrap](https://getbootstrap.com)** - CSS Framework
- **[Blade](https://laravel.com/docs/blade)** - Templating Engine
- **[Composer](https://getcomposer.com)** - Dependency Manager

---

## 📝 License & Subscription

This system operates on a subscription-based license model:

- License keys are required for system access
- Multiple license types available (Monthly, Yearly, 2-Year, Lifetime)
- License management through admin panel
- Automatic expiration warnings (30 days before)
- Easy renewal process

**For License Inquiries:** Contact the system provider

---

## 🤝 Contributing

This is a custom system for Beira Unida. Modifications should be coordinated with the school administration and system provider.

---

## 🎓 Credits

**Customized for:**  
Beira United Christian Academy / Colégio Cristão Beira Unida

**Based on:**  
[ICTSchool](https://github.com/ictinnovations/ICTSchool) by ICT Innovations

**Customization Date:** October 2025  
**Version:** 1.0

---

## 📄 System Requirements

### Server Requirements

- PHP >= 8.2
- MySQL >= 5.7 or MariaDB >= 10.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

### Recommended Specifications

- Memory: 512MB minimum, 1GB recommended
- Storage: 5GB minimum
- Bandwidth: Unlimited recommended

---

## 🚀 Deployment Options

1. **cPanel Hosting** (Recommended) - See [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)
2. **VPS/Dedicated Server** - Standard Laravel deployment
3. **Cloud Platforms** - AWS, DigitalOcean, Linode, etc.

---

## ✨ What's Next?

After deployment:

1. ✅ Upload school logo
2. ✅ Activate license
3. ✅ Configure school information
4. ✅ Add teachers
5. ✅ Enroll students
6. ✅ Set up fee structure
7. ✅ Begin daily operations

**Ready to deploy?** → Start with [QUICK_START_GUIDE.md](QUICK_START_GUIDE.md)

---

<div align="center">

**Made with ❤️ for Beira Unida**

*Shaping Hearts and Minds / Formando corações e mentes*

</div>
