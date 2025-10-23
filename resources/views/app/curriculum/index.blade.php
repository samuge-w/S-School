@extends('layouts.master')

@section('style')
<style>
.curriculum-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 25px;
    margin-bottom: 20px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.curriculum-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.curriculum-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 2px solid #4A90E2;
    padding-bottom: 10px;
}
.curriculum-name {
    font-size: 24px;
    font-weight: 600;
    color: #2c3e50;
    margin: 0;
}
.curriculum-badge {
    background: #4A90E2;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.curriculum-description {
    color: #7f8c8d;
    font-size: 14px;
    margin-bottom: 15px;
}
.subject-count {
    display: inline-block;
    background: #ecf0f1;
    padding: 8px 15px;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 14px;
}
.subject-count i {
    color: #50C878;
    margin-right: 5px;
}
.view-subjects-btn {
    background: #50C878;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s;
}
.view-subjects-btn:hover {
    background: #45b369;
}
.page-header {
    background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}
.page-header h1 {
    margin: 0;
    font-size: 32px;
    font-weight: 600;
}
.page-header p {
    margin: 10px 0 0 0;
    opacity: 0.9;
    font-size: 16px;
}
.info-box {
    background: #e8f4fd;
    border-left: 4px solid #4A90E2;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}
.info-box i {
    color: #4A90E2;
    margin-right: 10px;
}
</style>
@stop

@section('content')

<div class="page-header">
    <h1><i class="glyphicon glyphicon-book"></i> {{ __('Curriculum Management') }}</h1>
    <p>{{ __('Beira Unida supports three curricula: Ambleside Schools International, Cambridge, and Curriculum Nacional') }}</p>
</div>

<div class="info-box">
    <i class="glyphicon glyphicon-info-sign"></i>
    <strong>{{ __('Information') }}:</strong> {{ __('These curricula and subjects are pre-configured for Beira Unida. Each curriculum has grade-specific subjects that are automatically assigned when enrolling students.') }}
</div>

<div class="row">
    <div class="col-md-12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            {{ Session::get('success') }}
        </div>
        @endif

        @if(!empty($curriculums) && count($curriculums) > 0)
            @foreach($curriculums as $curriculum)
            <div class="curriculum-card">
                <div class="curriculum-header">
                    <h2 class="curriculum-name">{{ $curriculum->name }}</h2>
                    <span class="curriculum-badge">{{ $curriculum->is_active ? __('Active') : __('Inactive') }}</span>
                </div>

                @if($curriculum->description)
                <p class="curriculum-description">{{ $curriculum->description }}</p>
                @endif

                <div class="curriculum-stats">
                    <span class="subject-count">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <strong>{{ $curriculum->subjects->count() }}</strong> {{ __('Subjects') }}
                    </span>
                    
                    <a href="{{ url('/curriculum/view/' . $curriculum->id) }}" class="btn view-subjects-btn">
                        <i class="glyphicon glyphicon-eye-open"></i> {{ __('View Subjects') }}
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-warning-sign"></i>
                {{ __('No curricula found. Please run the Beira Unida seeder') }}: <code>php artisan db:seed --class=BeiraUnidaSeeder</code>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-question-sign"></i> {{ __('How to Use Curricula') }}</h2>
                </div>
                <div class="box-content" style="padding: 20px;">
                    <h4><strong>{{ __('For Administrators') }}:</strong></h4>
                    <ul>
                        <li>{{ __('Review the subjects for each curriculum to understand what is taught') }}</li>
                        <li>{{ __('When admitting students, select the appropriate curriculum based on their educational path') }}</li>
                        <li>{{ __('Subjects will automatically be available based on curriculum and grade level') }}</li>
                    </ul>

                    <h4><strong>{{ __('Curriculum Descriptions') }}:</strong></h4>
                    <ul>
                        <li><strong>Ambleside Schools International:</strong> {{ __('Charlotte Mason-based methodology focusing on living education, literature, nature study, and character development') }}</li>
                        <li><strong>Cambridge International:</strong> {{ __('International standard curriculum preparing students for Cambridge examinations (IGCSE, A-Level)') }}</li>
                        <li><strong>Curriculum Nacional:</strong> {{ __('Mozambique National Curriculum meeting government education requirements') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
    // Add any JavaScript if needed for future enhancements
</script>
@stop

