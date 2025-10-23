<?php

namespace App\Services;

use App\Models\Student;
use Carbon\Carbon;

class StudentIdGenerator
{
    /**
     * Generate a new student ID
     * Format: BCBA-YYYY-XXXX
     * BCBA = Beira Christian Beira Academy
     * YYYY = Current Year
     * XXXX = Sequential number (4 digits)
     *
     * @return string
     */
    public static function generate(): string
    {
        $year = Carbon::now()->year;
        $prefix = "BCBA-{$year}-";

        // Get the latest student ID for current year
        $latestStudent = Student::where('regiNo', 'LIKE', "{$prefix}%")
            ->orderBy('regiNo', 'desc')
            ->first();

        if ($latestStudent) {
            // Extract the sequential number
            $lastNumber = (int) substr($latestStudent->regiNo, -4);
            $newNumber = $lastNumber + 1;
        } else {
            // First student of the year
            $newNumber = 1;
        }

        // Format with leading zeros (4 digits)
        $sequential = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $prefix . $sequential;
    }

    /**
     * Validate if a student ID follows the correct format
     *
     * @param string $studentId
     * @return bool
     */
    public static function validate(string $studentId): bool
    {
        // Pattern: BCBA-YYYY-XXXX
        return preg_match('/^BCBA-\d{4}-\d{4}$/', $studentId) === 1;
    }

    /**
     * Check if a student ID already exists
     *
     * @param string $studentId
     * @return bool
     */
    public static function exists(string $studentId): bool
    {
        return Student::where('regiNo', $studentId)->exists();
    }
}




