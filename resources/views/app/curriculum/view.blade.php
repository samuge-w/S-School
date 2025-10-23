@extends('layouts.master')

@section('style')
<style>
.curriculum-detail-header {
    background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}
.curriculum-detail-header h1 {
    margin: 0;
    font-size: 32px;
    font-weight: 600;
}
.curriculum-detail-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 16px;
}
.back-btn {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 15px;
}
.back-btn:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
}
.grade-section {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 20px;
}
.grade-header {
    background: #4A90E2;
    color: white;
    padding: 15px 20px;
    border-radius: 6px 6px 0 0;
    margin: -20px -20px 20px -20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.grade-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}
.subject-badge {
    background: rgba(255,255,255,0.2);
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
}
.subject-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.subject-item {
    padding: 12px 15px;
    border-bottom: 1px solid #ecf0f1;
    display: flex;
    align-items: center;
}
.subject-item:last-child {
    border-bottom: none;
}
.subject-item:hover {
    background: #f8f9fa;
}
.subject-icon {
    background: #50C878;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 16px;
}
.subject-name {
    font-size: 16px;
    font-weight: 500;
    color: #2c3e50;
}
.stats-box {
    background: #e8f4fd;
    border-left: 4px solid #4A90E2;
    padding: 20px;
    border-radius: 4px;
    margin-bottom: 20px;
}
.stat-item {
    display: inline-block;
    margin-right: 30px;
}
.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #4A90E2;
}
.stat-label {
    font-size: 14px;
    color: #7f8c8d;
    display: block;
}
.empty-state {
    text-align: center;
    padding: 40px;
    color: #95a5a6;
}
.empty-state i {
    font-size: 64px;
    margin-bottom: 15px;
}
</style>
@stop

@section('content')

<div class="curriculum-detail-header">
    <a href="{{ url('/curriculum') }}" class="back-btn">
        <i class="glyphicon glyphicon-arrow-left"></i> {{ __('Back to Curricula') }}
    </a>
    <h1><i class="glyphicon glyphicon-education"></i> {{ $curriculum->name }}</h1>
    @if($curriculum->description)
    <p>{{ $curriculum->description }}</p>
    @endif
</div>

<div class="stats-box">
    <div class="stat-item">
        <span class="stat-number">{{ $curriculum->subjects->count() }}</span>
        <span class="stat-label">{{ __('Total Subjects') }}</span>
    </div>
    <div class="stat-item">
        <span class="stat-number">{{ $gradeGroups->count() }}</span>
        <span class="stat-label">{{ __('Grade Levels') }}</span>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if($gradeGroups->count() > 0)
            @foreach($gradeGroups as $grade => $subjects)
            <div class="grade-section">
                <div class="grade-header">
                    <h3 class="grade-title">
                        <i class="glyphicon glyphicon-th-list"></i> {{ $grade }}
                    </h3>
                    <span class="subject-badge">{{ count($subjects) }} {{ __('Subjects') }}</span>
                </div>
                
                <ul class="subject-list">
                    @foreach($subjects as $subject)
                    <li class="subject-item">
                        <div class="subject-icon">
                            <i class="glyphicon glyphicon-book"></i>
                        </div>
                        <span class="subject-name">{{ $subject->subject_name }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        @else
            <div class="grade-section">
                <div class="empty-state">
                    <i class="glyphicon glyphicon-folder-open"></i>
                    <h3>{{ __('No Subjects Found') }}</h3>
                    <p>{{ __('This curriculum does not have any subjects assigned yet.') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-info-sign"></i> {{ __('About This Curriculum') }}</h2>
                </div>
                <div class="box-content" style="padding: 20px;">
                    @if($curriculum->name == 'Ambleside Schools International')
                        <h4><strong>{{ __('Ambleside Schools International') }}</strong></h4>
                        <p>{{ __('Based on Charlotte Mason\'s philosophy of education, Ambleside focuses on:') }}</p>
                        <ul>
                            <li>{{ __('Living books and first-hand experiences') }}</li>
                            <li>{{ __('Nature study and outdoor learning') }}</li>
                            <li>{{ __('Short, focused lessons') }}</li>
                            <li>{{ __('Narration as a primary learning tool') }}</li>
                            <li>{{ __('Character development alongside academics') }}</li>
                        </ul>
                        <p><strong>{{ __('Best for') }}:</strong> {{ __('Students in pre-school through grade 10-11 seeking a literature-rich, values-based education') }}</p>
                    
                    @elseif($curriculum->name == 'Cambridge')
                        <h4><strong>{{ __('Cambridge International Curriculum') }}</strong></h4>
                        <p>{{ __('An internationally recognized curriculum preparing students for Cambridge examinations:') }}</p>
                        <ul>
                            <li>{{ __('Cambridge Lower Secondary (Grades 7-8)') }}</li>
                            <li>{{ __('Cambridge IGCSE (Grade 9-10)') }}</li>
                            <li>{{ __('Cambridge International AS & A Level (Grade 11)') }}</li>
                            <li>{{ __('Globally recognized qualifications') }}</li>
                            <li>{{ __('Critical thinking and problem-solving focus') }}</li>
                        </ul>
                        <p><strong>{{ __('Best for') }}:</strong> {{ __('Students seeking international qualifications and university preparation') }}</p>
                    
                    @elseif($curriculum->name == 'Curriculum Nacional')
                        <h4><strong>{{ __('Mozambique National Curriculum') }}</strong></h4>
                        <p>{{ __('The official curriculum mandated by the Mozambique Ministry of Education:') }}</p>
                        <ul>
                            <li>{{ __('Aligned with national education standards') }}</li>
                            <li>{{ __('Taught in Portuguese') }}</li>
                            <li>{{ __('Includes Mozambican history and geography') }}</li>
                            <li>{{ __('Prepares for national examinations') }}</li>
                            <li>{{ __('Meets government requirements') }}</li>
                        </ul>
                        <p><strong>{{ __('Best for') }}:</strong> {{ __('Students following the Mozambican education system') }}</p>
                    @endif

                    <div class="alert alert-info" style="margin-top: 20px;">
                        <i class="glyphicon glyphicon-question-sign"></i>
                        <strong>{{ __('Note') }}:</strong> {{ __('When admitting a new student, you will select which curriculum they follow. The system will then automatically make the appropriate subjects available based on their grade level.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
    // Future: Add print functionality or export subject list
</script>
@stop

