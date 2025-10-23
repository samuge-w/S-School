# Beira Unida School Management System
## User Guide & Administration Manual

**Colégio Cristão Beira Unida / Beira United Christian Academy**

*"Formando corações e mentes" / "Shaping Hearts and Minds"*

---

## Table of Contents

1. [System Overview](#system-overview)
2. [Getting Started](#getting-started)
3. [License Management](#license-management)
4. [School Information Management](#school-information-management)
5. [Logo Management](#logo-management)
6. [Language Settings](#language-settings)
7. [Curriculum Management](#curriculum-management)
8. [Student Management](#student-management)
9. [Family Management](#family-management)
10. [Financial Management](#financial-management)
11. [Reports](#reports)
12. [Backup Procedures](#backup-procedures)
13. [Troubleshooting](#troubleshooting)

---

## System Overview

This customized school management system is specifically designed for Beira Unida and includes:

- **Bilingual Interface**: English (UK) and Portuguese (Mozambique)
- **Three Curricula Support**:
  - Ambleside Schools International
  - Cambridge International
  - Mozambique National Curriculum
- **License Management**: Subscription-based (Monthly/Yearly/2-Year/Lifetime)
- **Family-Based Billing**: Group siblings for fee management
- **Auto-Generated Student IDs**: Format BCBA-YYYY-XXXX
- **Comprehensive Tracking**: Academic, Attendance, Extracurricular, Financial

---

## Getting Started

### First Time Login

1. Navigate to your school's URL (e.g., `https://beiraunida.yourhost.com`)
2. Default credentials will be provided by your system administrator
3. **Important**: Change your password immediately after first login

### System Requirements

- Modern web browser (Chrome, Firefox, Safari, Edge)
- Internet connection
- Recommended screen resolution: 1366x768 or higher

---

## License Management

### Understanding License Types

| Type | Duration | Best For |
|------|----------|----------|
| Monthly | 30 days | Trial or short-term use |
| Yearly | 12 months | Standard subscription |
| 2-Year | 24 months | Long-term commitment (discounted) |
| Lifetime | Permanent | One-time purchase |

### Activating a License

1. Click your profile menu (top right)
2. Select **"License Settings"**
3. Enter the license key provided by your vendor
4. Click **"Activate"**
5. Verify the expiration date displayed

### License Warnings

- System will display warnings **30 days** before expiration
- Access will be restricted if license expires
- Contact your vendor for renewal

### Generating License Keys (Admin Only)

**For System Administrators/Directors:**

1. Go to License Settings
2. Scroll to "Generate License" section
3. Select license type
4. Enter optional notes
5. Click **"Generate"**
6. Copy the generated key immediately
7. Provide to the school or save securely

---

## School Information Management

### Updating School Details

1. Navigate to **Settings** → **Institute**
2. Update the following fields:
   - School Name (English & Portuguese)
   - Established Year
   - Contact Information (Phone, Email, Website)
   - Address
   - NUIT (Tax ID)
   - Facebook Page
   - Vision Statement (EN & PT)
   - Mission Statement (EN & PT)
   - Motto (EN & PT)

### Current School Information

**English:**
- Name: Beira United Christian Academy
- Motto: "Shaping Hearts and Minds"

**Portuguese:**
- Nome: BEIRA UNIDA COLÉGIO CRISTÃO  
- Lema: "Formando corações e mentes"

**Contact:**
- NUIT: 401 866 426
- Email: director@beiraunida.com
- Phone: (+258) 85 220 3932
- Address: Samora Machel, Instituto Bíblico de Sofala (IBS), Pioneiros, Sofala, Beira

---

## Logo Management

### Uploading/Changing the School Logo

**Method 1: Via File Manager (cPanel)**

1. Access cPanel → File Manager
2. Navigate to `/public_html/your-site/public/assets/images/schools/`
3. Upload new logo file
4. Rename to: `beira-unida-logo.png`
5. Refresh your browser

**Method 2: Via Institute Settings**

1. Go to Settings → Institute
2. Click on logo upload field
3. Select your logo file (PNG recommended, max 500KB)
4. Save changes

**Logo Specifications:**
- Format: PNG (with transparent background recommended)
- Dimensions: 300x300 pixels minimum
- File size: Under 500KB
- Aspect ratio: Square or horizontal preferred

---

## Language Settings

### Switching Interface Language

**For Individual Users:**

1. Click profile menu (top right)
2. Select language button: **🇬🇧 EN** or **🇵🇹 PT**
3. Interface will reload in selected language

**Supported Languages:**
- **EN**: English (United Kingdom)
- **PT**: Português (Moçambique)

### Language Preference

Your language preference is saved to your user profile and will persist across sessions.

---

## Curriculum Management

### Available Curricula

**1. Ambleside Schools International**
- Charlotte Mason-based methodology
- Subjects: Bible, Literature, Math, Science, History, etc.
- Grades: Pré 3^4 through 10ª^11

**2. Cambridge International**
- International standard curriculum
- Subjects: Math, English, Science, ICT, Business, etc.
- Grades: 7ª^8ª through 10ª^11

**3. Curriculum Nacional (Mozambique)**
- National curriculum requirements
- Subjects: Português, Matemática, Ciências, etc.
- All grade levels

### Assigning Curriculum to Students

1. Go to **Students** → **Add Student** or **Edit Student**
2. Select **Curriculum** from dropdown
3. Choose **Class/Grade**
4. Subjects will automatically populate based on curriculum and grade
5. Save

---

## Student Management

### Student Information Fields

**Required Fields:**
- Student ID (auto-generated)
- Full Name (First, Middle, Last)
- Date of Birth
- Gender
- Nationality
- Class/Grade
- Curriculum

**Guardian Information:**
- Guardian Name
- Guardian Contact
- Father Name & Contact
- Mother Name & Contact

**Beira Unida Specific:**
- Family ID (for sibling grouping)
- Church/Community affiliation

**Address:**
- Present Address
- Permanent Address

### Auto-Generated Student IDs

Format: **BCBA-YYYY-XXXX**

Example: `BCBA-2025-0001`

- **BCBA**: Beira Christian Beira Academy
- **YYYY**: Year of enrollment
- **XXXX**: Sequential number (resets each year)

IDs are automatically assigned when creating a new student.

### Enrolling a New Student

1. Navigate to **Students** → **Add Student**
2. System will auto-generate Student ID
3. Fill in all required information
4. Assign Family ID (if student has siblings)
5. Select Curriculum and Class
6. Upload student photo (optional)
7. Click **Save**

### Family Grouping

Students with the same **Family ID** will be grouped for:
- Combined fee invoices
- Family discounts
- Sibling reports

**Example:**
- Student 1: João Silva - Family ID: FAM-2025-001
- Student 2: Maria Silva - Family ID: FAM-2025-001
- Both will appear on same family invoice

---

## Financial Management

### Fee Structure

**Monthly Fees:**
- Base tuition per student
- Curriculum-specific fees
- Grade-level adjustments

**Additional Fees:**
- Enrollment/Registration
- Books and Materials
- Extracurricular Activities
- Late Payment Penalties

### Family-Based Billing

Families with multiple students:
1. Assign same Family ID to all siblings
2. Create family invoice (consolidated)
3. Apply family discounts if applicable
4. Track payments at family level

### Recording Payments

1. Go to **Fees** → **Fee Collection**
2. Search for student or family
3. Enter payment amount
4. Select payment method:
   - Cash
   - Bank Transfer
   - Mobile Money (M-Pesa, etc.)
   - Cheque
5. Enter payment date
6. Save transaction
7. Print receipt

### Overdue Fees

System automatically:
- Tracks overdue payments
- Calculates late penalties
- Generates reminder messages
- Updates current status

---

## Reports

### Available Reports

**Academic Reports:**
- Student Grade Sheets
- Class Performance Reports
- Exam Results
- Subject-wise Analysis

**Attendance Reports:**
- Daily Attendance
- Monthly Attendance Summary
- Student-wise Attendance
- Class Attendance Overview

**Financial Reports:**
- Fee Collection Report
- Outstanding Fees
- Payment History
- Family Account Summary

**Student Reports:**
- Student Profile
- Enrollment History
- Extracurricular Participation

### Generating Reports

1. Navigate to specific report section
2. Select date range/academic year
3. Choose class/student/subject filters
4. Click **Generate Report**
5. Options:
   - **View**: Display on screen
   - **Print**: Direct printing
   - **Export**: Download as PDF/Excel

---

## Backup Procedures

### Regular Backups (Recommended)

**Frequency:** Daily (automated) or Weekly (manual)

**What to Backup:**
1. Database (all student/financial data)
2. Uploaded files (photos, documents)
3. Configuration files

### Manual Backup via cPanel

**Database Backup:**
1. cPanel → phpMyAdmin
2. Select your database
3. Click "Export"
4. Choose "Quick" method
5. Click "Go"
6. Save file to secure location

**File Backup:**
1. cPanel → File Manager
2. Compress entire application folder
3. Download compressed file
4. Store in secure location (cloud/external drive)

### Backup Storage

- Keep at least 3 copies
- Store in different locations
- Cloud storage recommended (Google Drive, Dropbox)
- Test restore procedure periodically

---

## Troubleshooting

### Common Issues

**Problem: Cannot log in**
- Solution: Verify username and password
- Check if Caps Lock is on
- Contact administrator for password reset

**Problem: License expired message**
- Solution: Contact vendor for renewal
- Enter new license key in License Settings

**Problem: Student ID not generating**
- Solution: Check if auto-generation is enabled
- Verify database permissions
- Contact technical support

**Problem: Logo not displaying**
- Solution: Check file format (PNG recommended)
- Verify file size (< 500KB)
- Clear browser cache
- Re-upload logo

**Problem: Language not switching**
- Solution: Clear browser cache
- Log out and log in again
- Check if both language files exist

**Problem: Reports not generating**
- Solution: Check date range selection
- Verify data exists for selected criteria
- Try different browser
- Contact support if persists

### Getting Help

**Technical Support:**
- Email: [Your support email]
- Response time: 24-48 hours

**School Contact:**
- Director: director@beiraunida.com
- Phone: (+258) 85 220 3932

**Emergency Issues:**
- Database errors
- System downtime
- Data loss
Contact immediately via phone

---

## Best Practices

1. **Regular Backups**: Backup database weekly minimum
2. **Update Information**: Keep student records current
3. **Fee Collection**: Record payments promptly
4. **Attendance**: Mark daily attendance before end of school day
5. **Reports**: Generate and review reports monthly
6. **License**: Renew 30 days before expiration
7. **Security**: Log out when finished, use strong passwords
8. **Training**: Ensure all staff are trained on the system

---

## System Maintenance

### Provider Responsibilities

- Server maintenance
- Software updates
- Security patches
- Technical support
- Backup monitoring

### School Responsibilities

- Data entry and accuracy
- User management
- License renewal
- Daily operations
- Logo and content updates

---

## Contact Information

**Beira United Christian Academy**
Colégio Cristão Beira Unida

📍 Samora Machel, Instituto Bíblico de Sofala (IBS)
   Pioneiros, Sofala, Beira
   
📧 director@beiraunida.com

📞 (+258) 85 220 3932

🌐 www.beiraunida.com

📘 facebook.com/BeiraUnida

**NUIT:** 401 866 426

---

**Vision:**
*Partnering with the community to provide exceptional, international standard education, where the child is instructed, nurtured and disciplined for a full life: creative and rich in relationship with Christ and neighbour.*

**Visão:**
*Ser parceira da comunidade para providenciar uma educação excepcional de padrão internacional, onde a criança é instruída, nutrida e disciplinada para uma vida plena: criativa e rica no relacionamento com Cristo e com o próximo.*

---

*This system was customized specifically for Beira Unida. For technical assistance or customization requests, contact your system provider.*

**Version:** 1.0  
**Last Updated:** October 2025




