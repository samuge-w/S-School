# 🔑 License Key System - Complete Explanation

## Overview

The license key system controls who can access the Beira Unida School Management System and for how long. It's a subscription-based model that allows you (the provider) to:

1. Control access to the system
2. Generate revenue through subscriptions
3. Manage multiple schools (if you expand)
4. Automatically enforce expiration

---

## 🎯 How It Works

### Simple Flow:

```
1. You generate a license key
   ↓
2. Send key to school
   ↓
3. School enters key in system
   ↓
4. System activates and calculates expiry
   ↓
5. School can use system until expiry
   ↓
6. System warns 30 days before expiry
   ↓
7. School contacts you for renewal
   ↓
8. You generate new key (after payment)
   ↓
9. Cycle repeats
```

---

## 💳 License Types

### 1. Monthly License
- **Duration:** 30 days
- **Best for:** Trial periods, short-term testing
- **Use case:** School wants to try before committing
- **Key format:** `BCBA-XXXXXXXXXXXX`
- **Example:** School pays monthly subscription

**How it works:**
```
Activation: October 22, 2025
Expiry: November 21, 2025
Warning appears: October 22, 2025 (30 days before)
```

### 2. Yearly License
- **Duration:** 365 days (12 months)
- **Best for:** Standard annual subscription
- **Use case:** Most common option
- **Typical discount:** 2 months free vs monthly

**How it works:**
```
Activation: October 22, 2025
Expiry: October 22, 2026
Warning appears: September 22, 2026
```

### 3. 2-Year License
- **Duration:** 730 days (24 months)
- **Best for:** Long-term commitment
- **Use case:** School gets discount for 2-year prepay
- **Typical discount:** 4 months free vs yearly

**How it works:**
```
Activation: October 22, 2025
Expiry: October 22, 2027
Warning appears: September 22, 2027
```

### 4. Lifetime License
- **Duration:** Permanent (never expires)
- **Best for:** One-time purchase
- **Use case:** School owns the license forever
- **Higher upfront cost, but no recurring fees**

**How it works:**
```
Activation: October 22, 2025
Expiry: Never
Warning: Never appears
```

---

## 🔐 License Key Format

**Format:** `BCBA-XXXXXXXXXXXX`

**Example:** `BCBA-A5F2E9D4B1C7`

**Components:**
- `BCBA` - Prefix (Beira Christian Beira Academy)
- `XXXXXXXXXXXX` - Random 12-character hash

**Generation Method:**
```php
$licenseKey = 'BCBA-' . strtoupper(substr(md5(time() . rand()), 0, 12));
// Result: BCBA-3F7A2B9E4D1C
```

**Properties:**
- Unique (collision nearly impossible)
- Not sequential (can't be guessed)
- Easy to type (no special characters)
- Professional appearance

---

## 🎛️ How to Generate License Keys

### Method 1: Via Admin Panel (Recommended)

**Steps:**
1. Login as Director/Admin
2. Click your profile (top right)
3. Select "License Settings"
4. Scroll to "Generate License" section
5. Select license type from dropdown
6. (Optional) Enter school ID for tracking
7. (Optional) Add notes (e.g., "Paid via M-Pesa on Oct 22")
8. Click "Generate"
9. **COPY THE KEY IMMEDIATELY** (shown only once)
10. Send to school via email/WhatsApp

**Screenshot of Generation:**
```
┌─────────────────────────────────────┐
│ Generate License (Admin Only)       │
├─────────────────────────────────────┤
│ License Type: [Yearly ▼]            │
│ School ID: beira-unida-001          │
│ Notes: Annual subscription 2025-26  │
│                                      │
│ [Generate License]                   │
└─────────────────────────────────────┘

Generated Key: BCBA-A5F2E9D4B1C7
✓ License generated successfully!
```

### Method 2: Via Database (Manual)

**Only if admin panel unavailable:**

```sql
INSERT INTO licenses (license_key, type, issued_date, status, school_id, notes, created_at, updated_at)
VALUES ('BCBA-MANUAL123456', 'yearly', NOW(), 'active', 'beira-unida', 'Manually created', NOW(), NOW());
```

---

## 📧 Sending Keys to School

### Professional Email Template:

```
Subject: Beira Unida School System - License Key

Dear Director,

Thank you for your subscription to the Beira Unida School Management System.

Your license details:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
License Key: BCBA-A5F2E9D4B1C7
License Type: Yearly
Valid From: October 22, 2025
Expires On: October 22, 2026
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

How to activate:
1. Login to your system
2. Click your profile (top right)
3. Select "License Settings"
4. Enter the license key above
5. Click "Activate"

The system will display your expiration date after activation.

Need help? Reply to this email or call (+258) [your number]

Best regards,
[Your Name]
[Your Company]
```

### WhatsApp Message:

```
🎓 Beira Unida School System

Your license key is ready!

🔑 Key: BCBA-A5F2E9D4B1C7
📅 Type: Yearly
⏰ Valid until: Oct 22, 2026

To activate:
Profile → License Settings → Enter key → Activate

Need help? Call me! 📞
```

---

## 🔄 Activation Process (School Side)

**What the school does:**

1. **Login to system**
   - Go to their URL (e.g., beiraunida.yourhost.com)
   - Login with credentials

2. **Navigate to License Settings**
   - Click profile menu (top right)
   - Select "License Settings"

3. **Enter License Key**
   - See form: "Activate License"
   - Type or paste: `BCBA-A5F2E9D4B1C7`
   - Click "Activate"

4. **Confirmation**
   - Green success message appears
   - Expiration date displayed
   - System now accessible

**Behind the scenes:**
```php
// System receives key
$license = License::where('license_key', $request->license_key)->first();

// Validates key exists
if (!$license) {
    return error("Invalid key");
}

// Deactivates old licenses
License::where('status', 'active')->update(['status' => 'suspended']);

// Activates new license
$license->issued_date = now();
$license->status = 'active';

// Calculates expiry based on type
if ($license->type == 'yearly') {
    $license->expiry_date = now()->addYear();
}

$license->save();
```

---

## ⚠️ Expiration Warnings

### 30-Day Warning

**When:** 30 days before expiry  
**Where:** Dashboard banner (top of screen)  
**Message:** "Your license will expire in 30 days. Please renew soon."

**Example:**
```
┌────────────────────────────────────────────────┐
│ ⚠️ Your license will expire in 30 days.       │
│    Please renew soon.                          │
└────────────────────────────────────────────────┘
```

### 7-Day Warning

**When:** 7 days before expiry  
**Where:** Dashboard banner (orange/red)  
**Message:** "Your license will expire in 7 days. Please contact your provider."

### Expired License

**When:** After expiry date  
**What happens:**
- User is redirected to License Settings
- Red error message: "Your license has expired. Please renew."
- Cannot access any system features
- Only License Settings page accessible

**Access Blocked:**
```
┌────────────────────────────────────────────────┐
│ ❌ License Expired                              │
│                                                 │
│ Your license expired on October 22, 2025.      │
│ Please contact your provider for renewal.      │
│                                                 │
│ Provider: [Your Contact Info]                  │
└────────────────────────────────────────────────┘
```

---

## 💰 Pricing Strategy (Suggestions)

### For Mozambique Market:

**Consider these factors:**
- School size
- Number of students
- Features used
- Local market rates

**Suggested Pricing (in USD, convert to MZN):**

| Type | Price | Effective Monthly | Savings |
|------|-------|-------------------|---------|
| Monthly | $100 | $100/month | - |
| Yearly | $1,000 | $83.33/month | 2 months free |
| 2-Year | $1,800 | $75/month | 6 months free |
| Lifetime | $5,000 | - | Unlimited |

**Or in MZN (Mozambican Metical):**
*(Assuming 1 USD = 63 MZN - adjust to current rate)*

| Type | Price (MZN) | Notes |
|------|-------------|-------|
| Monthly | 6,300 | Trial/testing |
| Yearly | 63,000 | Most popular |
| 2-Year | 113,400 | Best value |
| Lifetime | 315,000 | One-time payment |

**Payment Methods:**
- Bank transfer
- M-Pesa / Mpesa
- Cash (for local schools)
- Invoicing for institutions

---

## 📊 License Management Dashboard

### What You Can Track:

**Per School:**
- License key issued
- Type and duration
- Activation date
- Expiry date
- Status (active/expired/suspended)
- School ID
- Notes (payment method, date, etc.)

**Database Query:**
```sql
SELECT 
    license_key,
    type,
    issued_date,
    expiry_date,
    status,
    school_id,
    notes
FROM licenses
WHERE status = 'active'
ORDER BY expiry_date ASC;
```

**Renewal Tracking:**
```sql
-- Schools expiring in next 30 days
SELECT * FROM licenses 
WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)
AND type != 'lifetime';
```

---

## 🔄 Renewal Process

### When School License is Expiring:

**30 Days Before:**
1. System shows warning to school
2. School contacts you for renewal
3. You send invoice/payment request

**After Payment Received:**
1. Generate new license key (same type or upgrade)
2. Send key to school
3. School activates new key
4. Old key automatically suspended
5. New expiry date calculated

**Important:** Each renewal is a NEW key, not an extension of the old one.

---

## 🛡️ Security Features

### Built-in Protection:

1. **Unique Keys**
   - Random generation prevents guessing
   - Hash-based, not sequential

2. **One Active License**
   - Only one license can be active at a time
   - New activation suspends old ones

3. **Validation**
   - Key must exist in database
   - Key must match exact format
   - Type must be valid

4. **Middleware Protection**
   - All routes check license status
   - Expired licenses block access
   - Redirects to activation page

5. **Audit Trail**
   - All activations logged
   - Timestamps tracked
   - Status changes recorded

---

## 🎯 Best Practices

### For You (Provider):

1. **Keep Records**
   - Track which school has which key
   - Note payment dates and methods
   - Set reminders for renewals

2. **Communicate Early**
   - Contact schools 45 days before expiry
   - Remind at 30, 15, and 7 days
   - Make renewal easy

3. **Offer Upgrades**
   - Monthly → Yearly (discount)
   - Yearly → 2-Year (better discount)
   - Any → Lifetime (premium offer)

4. **Test Keys**
   - Always test generated keys locally
   - Verify expiration calculations
   - Check warning systems

### For Schools:

1. **Activate Promptly**
   - Don't wait to activate received keys
   - Note expiration date in calendar

2. **Plan Renewals**
   - Budget for renewal before expiry
   - Contact provider early

3. **Keep Provider Info**
   - Save provider contact details
   - Know who to call for renewal

---

## 📞 Support Scenarios

### Scenario 1: "I Lost My License Key"

**Solution:**
```sql
-- Look up their key
SELECT license_key, expiry_date 
FROM licenses 
WHERE school_id = 'beira-unida' 
AND status = 'active';
```

Send them the existing key. No need to generate new one.

### Scenario 2: "Key Won't Activate"

**Troubleshooting:**
1. Check key was typed correctly (copy-paste)
2. Verify key exists in database
3. Check if key already activated elsewhere
4. Look for error in logs

### Scenario 3: "Can We Extend Current License?"

**Answer:** No, generate a new key. Old key auto-suspends.

### Scenario 4: "We Paid But System Still Blocked"

**Check:**
1. Did they activate the new key?
2. Is new key in database?
3. Check license status

---

## 🔧 Technical Details

### Database Schema:

```sql
CREATE TABLE licenses (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    license_key VARCHAR(255) UNIQUE,
    type ENUM('monthly','yearly','2year','lifetime'),
    issued_date DATE,
    expiry_date DATE NULL,
    status ENUM('active','expired','suspended'),
    school_id VARCHAR(255) NULL,
    notes TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### License Model Methods:

```php
$license->isValid()           // Returns true/false
$license->daysUntilExpiry()   // Returns integer or null
$license->isExpiringSoon()    // Returns true if <30 days
$license->activate()          // Activates and sets expiry
$license->checkStatus()       // Updates status if expired
```

---

## ✅ Quick Reference

**Generate Key:**
Profile → License Settings → Generate License

**Activate Key:**
Profile → License Settings → Enter Key → Activate

**Check Status:**
Profile → License Settings → View Active License

**Key Format:**
BCBA-XXXXXXXXXXXX (12 random characters)

**Warning Period:**
30 days before expiry

**Access Blocked:**
Immediately after expiry

---

**Questions?** Check LOCAL_TESTING_GUIDE.md for testing license features.




