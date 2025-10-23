<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    protected $fillable = [
        'curriculum_id',
        'subject_name',
        'grade_levels'
    ];

    protected $casts = [
        'grade_levels' => 'array',
    ];

    /**
     * Get the curriculum this subject belongs to
     */
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}




