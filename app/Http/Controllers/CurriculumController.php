<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\CurriculumSubject;

class CurriculumController extends Controller
{
    /**
     * Display all curriculums
     */
    public function index()
    {
        $curriculums = Curriculum::with('subjects')->where('is_active', true)->get();
        return view('app.curriculums.index', compact('curriculums'));
    }

    /**
     * Get subjects for a specific curriculum and grade
     *
     * @param int $curriculumId
     * @param string $grade
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubjects($curriculumId, $grade)
    {
        $curriculum = Curriculum::findOrFail($curriculumId);
        $subjects = $curriculum->subjectsForGrade($grade);

        return response()->json([
            'success' => true,
            'subjects' => $subjects
        ]);
    }

    /**
     * Get all subjects for a curriculum
     *
     * @param int $curriculumId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllSubjects($curriculumId)
    {
        $curriculum = Curriculum::with('subjects')->findOrFail($curriculumId);

        return response()->json([
            'success' => true,
            'curriculum' => $curriculum->name,
            'subjects' => $curriculum->subjects
        ]);
    }
}




