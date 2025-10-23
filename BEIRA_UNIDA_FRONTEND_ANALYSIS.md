# Beira Unida Front-End Implementation Analysis & Solution

## Date: October 23, 2025

## Executive Summary

The Beira Unida School Management System has been customized at the **backend level** with three curricula (Ambleside, Cambridge, Nacional), bilingual support, license management, and family-based billing. However, these features are **NOT VISIBLE or ACCESSIBLE** in the front-end interface.

---

## Issues Identified

### 1. **Curriculum Selection Missing in Student Admission**

**Problem:**
- Student admission form (`studentCreate.blade.php`) only shows "Class" dropdown
- No curriculum selection dropdown exists
- User cannot choose which curriculum (Ambleside, Cambridge, or Nacional) the student follows

**Impact:**
- Staff cannot properly enroll students according to curriculum
- Subjects cannot be auto-assigned based on curriculum + grade

**Evidence:**
- File: `resources/views/app/studentCreate.blade.php` lines 220-233
- Only "Class" selector exists, no curriculum field

---

### 2. **Curriculum Management Interface Does Not Exist**

**Problem:**
- `CurriculumController.php` exists with methods
- Database tables `curriculums` and `curriculum_subjects` exist and are seeded
- BUT: No view files exist for curriculum management

**Impact:**
- Admin cannot see what curricula exist
- Cannot view which subjects belong to each curriculum
- Cannot see which grades each subject applies to

**Evidence:**
- Controller exists: `app/Http/Controllers/CurriculumController.php`
- No views exist in: `resources/views/app/` for curriculum
- Route exists: `/api/curriculum/{curriculumId}/subjects/{grade}` but unused

---

### 3. **Secretary/Receptionist Role Not Integrated**

**Problem:**
- Role constant exists: `USER_RECEPTIONIST = 7` in `AppHelper.php`
- Permission system exists but no specific permissions for secretary
- No secretary-specific workflow or simplified admission interface

**Impact:**
- Secretary staff have no designated role or interface
- Cannot assign limited permissions for admission-only tasks
- No streamlined admission workflow for non-technical staff

**Evidence:**
- File: `app/Http/Helpers/AppHelper.php` line 28
- Permission list in `permissionController.php` has no "receptionist" permissions

---

### 4. **Sidebar Navigation Missing Beira Unida Features**

**Problem:**
- Sidebar menu (`sidebarmenu.blade.php`) does not show:
  - Curriculum Management
  - License Settings (only accessible via URL)
  - Language Switcher (only in top menu)
  - Student ID format info
  - Family grouping features

**Impact:**
- Users don't know these features exist
- Features are "hidden" and only accessible by direct URL
- Poor user experience and feature discoverability

**Evidence:**
- File: `resources/views/layouts/sidebarmenu.blade.php`
- No menu items for curriculum, license, or Beira Unida-specific features

---

### 5. **Subjects Pre-Loaded But Not Visible**

**Problem:**
- BeiraUnidaSeeder successfully seeds:
  - 18 Ambleside subjects
  - 11 Cambridge subjects
  - 9 Nacional subjects
- BUT: No interface to view these preloaded subjects by curriculum

**Impact:**
- Staff cannot see what subjects are available for each curriculum
- Cannot verify if correct subjects were seeded
- Cannot plan curriculum or timetables effectively

**Evidence:**
- Seeder: `database/seeders/BeiraUnidaSeeder.php` lines 58-127
- No view to display curriculum subjects exists

---

### 6. **Auto-Generated Student IDs Not Highlighted**

**Problem:**
- System generates student IDs in format: BCBA-YYYY-XXXX
- Feature exists in backend but not explained in UI
- Users may try to manually enter IDs

**Impact:**
- Confusion about student ID format
- Possible data entry errors
- Feature not understood by staff

---

### 7. **License Settings Hidden**

**Problem:**
- License management system exists and is documented
- Route exists: `/license/settings`
- BUT: Not in sidebar menu, only accessible via direct URL

**Impact:**
- Admin may forget to check license expiration
- No prominent warning when license is about to expire
- Critical feature is "hidden"

---

## Recommended Solutions

### PHASE 1: Immediate UI Improvements (Quick Wins)

#### 1.1 Add Curriculum Selection to Student Admission Form

**Action:** Update `studentCreate.blade.php` and `studentEdit.blade.php`

**Changes:**
- Add curriculum dropdown after "Class" field
- Load subjects dynamically based on curriculum + class selection
- Make curriculum a required field

**Files to Modify:**
- `resources/views/app/studentCreate.blade.php`
- `resources/views/app/studentEdit.blade.php`
- `app/Http/Controllers/studentController.php` (pass curricula to view)

---

#### 1.2 Create Curriculum Management Interface

**Action:** Create view files for curriculum management

**New Files to Create:**
- `resources/views/app/curriculum/index.blade.php` - List all curricula
- `resources/views/app/curriculum/view.blade.php` - View curriculum details and subjects
- `resources/views/app/curriculum/subjects.blade.php` - View subjects by grade

**Features:**
- Display all 3 curricula (Ambleside, Cambridge, Nacional)
- Show subjects for each curriculum
- Display which grades each subject applies to
- Read-only interface (subjects are pre-seeded)

---

#### 1.3 Update Sidebar Menu

**Action:** Update `sidebarmenu.blade.php` with Beira Unida features

**New Menu Items:**
- **Settings Section:**
  - License Settings (link to `/license/settings`)
  - Language: EN/PT (language switcher)
  - Institute Settings
  
- **Academics Section:**
  - Curriculum (link to curriculum management)
  - Subjects (existing)
  - Classes (existing)

- **Student Information Section:** (Already exists but reorganize)
  - Add Family Grouping menu item if not prominent
  - Highlight "Student Admission" for secretary role

---

### PHASE 2: Secretary Role Implementation

#### 2.1 Create Secretary Permissions

**Action:** Add secretary-specific permissions

**New Permissions:**
- `secretary_student_admission`
- `secretary_view_student`
- `secretary_edit_student_basic_info`
- `secretary_family_management`

**Files to Modify:**
- `app/Http/Controllers/permissionController.php`
- Database: Add permission entries

---

#### 2.2 Create Secretary Dashboard

**Action:** Create simplified dashboard for secretary role

**New File:**
- `resources/views/dashboard_secretary.blade.php`

**Features:**
- Prominent "New Student Admission" button
- List of pending admissions
- Today's new students
- Family search
- Quick access to student list

---

#### 2.3 Simplified Admission Form for Secretary

**Action:** Create secretary-friendly admission form

**New File:**
- `resources/views/app/student/admission_simple.blade.php`

**Features:**
- Wizard-style multi-step form
- Clear instructions in English and Portuguese
- Curriculum selection with descriptions
- Auto-generates student ID (read-only)
- Family ID search/link functionality
- Photo upload with preview
- Input validation with helpful error messages

---

### PHASE 3: Feature Enhancement

#### 3.1 Curriculum-Subject Integration

**Action:** Dynamic subject loading based on curriculum + class

**Changes:**
- AJAX call to `/api/curriculum/{curriculumId}/subjects/{grade}`
- Auto-populate subject list when creating timetable
- Show subjects on student profile based on their curriculum

**Files to Modify:**
- `resources/views/app/studentCreate.blade.php` (add JavaScript)
- `resources/views/app/teacherTimetable.blade.php`
- `resources/views/app/studentView.blade.php`

---

#### 3.2 License Warning Dashboard Widget

**Action:** Add license expiration widget to dashboard

**Changes:**
- Check license expiration date
- Show warning if < 30 days remaining
- Display prominently on dashboard
- Link to license settings

**Files to Modify:**
- `resources/views/dashboard.blade.php`
- `app/Http/Controllers/DashboardController.php`

---

#### 3.3 Language Switcher Improvement

**Action:** Make language switcher more prominent

**Changes:**
- Add language selector to sidebar (not just header)
- Show current language with flag icons
- Persist language preference per user

**Files to Modify:**
- `resources/views/layouts/sidebarmenu.blade.php`
- `resources/views/layouts/master.blade.php`

---

## Implementation Priority

### **HIGH PRIORITY** (Implement First)
1. ✅ Add curriculum selection to student admission form
2. ✅ Create curriculum management interface (view-only)
3. ✅ Update sidebar menu with Beira Unida features

### **MEDIUM PRIORITY** (Implement Next)
4. ⚠️ Create secretary role permissions
5. ⚠️ Simplified admission form for secretary
6. ⚠️ License warning widget on dashboard

### **LOW PRIORITY** (Nice to Have)
7. 📌 Secretary-specific dashboard
8. 📌 Multi-step wizard-style admission form
9. 📌 Enhanced language switcher

---

## Technical Notes

### Database Status
✅ **Curricula Table:** Populated with 3 curricula
✅ **Curriculum Subjects Table:** Populated with 38 subjects across all curricula
✅ **Grade Levels:** 7 grades defined (Pré 3^4 to 10ª^11)

### API Endpoints Available
- `GET /api/curriculum/{curriculumId}/subjects/{grade}` - Get subjects for curriculum and grade
- `GET /api/curriculum/{curriculumId}/all-subjects` - Get all subjects for curriculum

### Models Ready
- `App\Models\Curriculum`
- `App\Models\CurriculumSubject`
- `App\Models\Subject`

### Missing Components
- ❌ Curriculum view files
- ❌ Secretary permission entries
- ❌ Dynamic subject loading JavaScript
- ❌ Secretary dashboard view

---

## Expected Outcomes After Implementation

### For **Administrators:**
- ✅ Can view all curricula and their subjects
- ✅ Can see license status prominently
- ✅ Can switch language easily
- ✅ Full visibility of Beira Unida customizations

### For **Secretary/Receptionist:**
- ✅ Has dedicated role with limited permissions
- ✅ Can admit new students with simplified form
- ✅ Can search and link family members
- ✅ Cannot access financial or grade management

### For **Teachers:**
- ✅ Can see which curriculum each student follows
- ✅ Can view subjects for their classes
- ✅ Timetable shows curriculum-specific subjects

### For **Parents/Students:**
- ✅ Student profiles show curriculum clearly
- ✅ Can see which subjects they are enrolled in
- ✅ Bilingual interface works seamlessly

---

## Files to Be Created/Modified Summary

### New Files (16 files)
1. `resources/views/app/curriculum/index.blade.php`
2. `resources/views/app/curriculum/view.blade.php`
3. `resources/views/app/curriculum/subjects.blade.php`
4. `resources/views/dashboard_secretary.blade.php`
5. `resources/views/app/student/admission_simple.blade.php`
6. `public/js/curriculum.js` (dynamic subject loading)
7. `database/migrations/YYYY_MM_DD_add_secretary_permissions.php`
8. `resources/views/app/widgets/license_warning.blade.php`

### Modified Files (12 files)
1. `resources/views/layouts/sidebarmenu.blade.php` ⭐
2. `resources/views/app/studentCreate.blade.php` ⭐
3. `resources/views/app/studentEdit.blade.php` ⭐
4. `resources/views/app/studentView.blade.php`
5. `app/Http/Controllers/studentController.php` ⭐
6. `app/Http/Controllers/CurriculumController.php`
7. `app/Http/Controllers/DashboardController.php`
8. `app/Http/Controllers/permissionController.php`
9. `resources/views/dashboard.blade.php`
10. `routes/web.php`
11. `resources/lang/en/messages.php` (add curriculum translations)
12. `resources/lang/pt/messages.php` (add curriculum translations)

⭐ = Critical files for Phase 1

---

## Estimated Implementation Time

- **Phase 1 (High Priority):** 4-6 hours
- **Phase 2 (Medium Priority):** 6-8 hours
- **Phase 3 (Low Priority):** 4-6 hours

**Total:** 14-20 hours of development time

---

## Testing Checklist

After implementation, verify:

- [ ] Can select curriculum when creating new student
- [ ] Can view all 3 curricula in curriculum management
- [ ] Can see subjects for each curriculum by grade
- [ ] Sidebar shows curriculum menu item
- [ ] License settings accessible from sidebar
- [ ] Secretary role can be created with limited permissions
- [ ] Secretary can access admission form
- [ ] Student profile shows curriculum
- [ ] Subjects auto-load based on curriculum + grade
- [ ] Language switcher works from sidebar
- [ ] License warning appears on dashboard if < 30 days

---

## Conclusion

The Beira Unida customizations are **100% functional at the backend level** but are **NOT ACCESSIBLE from the front-end**. This creates a disconnect between what the system can do and what users can actually use.

By implementing the recommendations above (especially Phase 1), the system will become **immediately more usable** and will properly showcase all the Beira Unida-specific features that have been built.

**Key Takeaway:** The problem is NOT missing functionality, but missing **UI/UX to access that functionality**.

---

**Document Prepared By:** AI Assistant  
**For:** Beira Unida School Management System  
**Date:** October 23, 2025  
**Status:** Ready for Implementation

