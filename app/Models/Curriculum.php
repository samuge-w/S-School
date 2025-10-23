<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the subjects for this curriculum
     */
    public function subjects()
    {
        return $this->hasMany(CurriculumSubject::class);
    }

    /**
     * Get subjects for a specific grade level
     */
    public function subjectsForGrade($grade)
    {
        return $this->subjects()->whereJsonContains('grade_levels', $grade)->get();
    }
}




