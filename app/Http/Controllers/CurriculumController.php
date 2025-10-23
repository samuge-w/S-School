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
        return view('app.curriculum.index', compact('curriculums'));
    }
    
    /**
     * View a specific curriculum with its subjects organized by grade
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $curriculum = Curriculum::with('subjects')->findOrFail($id);
        
        // Group subjects by grade levels
        $gradeGroups = collect();
        foreach ($curriculum->subjects as $subject) {
            foreach ($subject->grade_levels as $grade) {
                if (!$gradeGroups->has($grade)) {
                    $gradeGroups->put($grade, collect());
                }
                $gradeGroups->get($grade)->push($subject);
            }
        }
        
        // Sort grade groups in order
        $gradeOrder = ['Pré 3^4', 'Pré 5', '1ª - 3ª', '4ª - 6ª', '7ª^8ª', '9ª', '10ª^11'];
        $gradeGroups = $gradeGroups->sortBy(function($subjects, $grade) use ($gradeOrder) {
            return array_search($grade, $gradeOrder);
        });
        
        return view('app.curriculum.view', compact('curriculum', 'gradeGroups'));
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




