@extends('layouts.master')

@section('style')
<style>
/* Beira Unida Dashboard Styling */
.beira-header {
    background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
    color: white;
    padding: 40px;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
}
.beira-header h1 {
    margin: 0;
    font-size: 36px;
    font-weight: 700;
}
.beira-header p {
    margin: 10px 0 0 0;
    opacity: 0.95;
    font-size: 18px;
}
.beira-motto {
    font-style: italic;
    font-size: 16px;
    opacity: 0.9;
    margin-top: 5px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
    border-left: 4px solid;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.stat-card.blue { border-left-color: #4A90E2; }
.stat-card.green { border-left-color: #50C878; }
.stat-card.orange { border-left-color: #FFA500; }
.stat-card.purple { border-left-color: #9B59B6; }

.stat-icon {
    font-size: 48px;
    opacity: 0.2;
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
}
.stat-content {
    position: relative;
}
.stat-number {
    font-size: 42px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}
.stat-label {
    font-size: 16px;
    color: #7f8c8d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quick-action-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
    margin-bottom: 20px;
    border-top: 3px solid;
}
.quick-action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.quick-action-card.blue { border-top-color: #4A90E2; }
.quick-action-card.green { border-top-color: #50C878; }
.quick-action-card.orange { border-top-color: #FFA500; }
.quick-action-card.purple { border-top-color: #9B59B6; }

.quick-action-icon {
    font-size: 48px;
    margin-bottom: 15px;
    color: #4A90E2;
}
.quick-action-card.green .quick-action-icon { color: #50C878; }
.quick-action-card.orange .quick-action-icon { color: #FFA500; }
.quick-action-card.purple .quick-action-icon { color: #9B59B6; }

.quick-action-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}
.quick-action-btn {
    display: inline-block;
    padding: 10px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
    margin-top: 10px;
}
.quick-action-btn.blue { 
    background: #4A90E2; 
    color: white; 
}
.quick-action-btn.blue:hover { 
    background: #357ABD; 
    color: white;
}
.quick-action-btn.green { 
    background: #50C878; 
    color: white; 
}
.quick-action-btn.green:hover { 
    background: #45b369;
    color: white;
}

.curriculum-overview {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}
.curriculum-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #ecf0f1;
    transition: background 0.2s;
}
.curriculum-item:last-child {
    border-bottom: none;
}
.curriculum-item:hover {
    background: #f8f9fa;
}
.curriculum-name {
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
}
.curriculum-count {
    background: #4A90E2;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.license-warning {
    background: #FFF3CD;
    border-left: 4px solid #FFA500;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.license-warning.danger {
    background: #F8D7DA;
    border-left-color: #DC3545;
}
.license-warning.success {
    background: #D4EDDA;
    border-left-color: #50C878;
}

.section-title {
    font-size: 22px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ecf0f1;
}

.today-highlight {
    background: #E8F4FD;
    border-left: 4px solid #4A90E2;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.today-highlight h4 {
    margin: 0 0 10px 0;
    color: #2c3e50;
}
</style>
@stop

@section('content')

{{-- Success/Error Messages --}}
@if (Session::get('success'))
<div class="alert alert-success">
  <button data-dismiss="alert" class="close" type="button">×</button>
  <strong>Success!</strong> {{ Session::get('success')}}
</div>
@endif

@if (Session::get('accessdined'))
<div class="alert alert-danger">
  <button data-dismiss="alert" class="close" type="button">×</button>
  <strong>Access Denied.</strong> {{ Session::get('accessdined')}}
</div>
@endif

{{-- Beira Unida Header with Language Switcher --}}
<div class="beira-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1>
                <i class="glyphicon glyphicon-home"></i> 
                {{ __('Welcome to Beira Unida') }}
            </h1>
            <p>Colégio Cristão Beira Unida | Beira United Christian Academy</p>
            <div class="beira-motto">"Formando corações e mentes" • "Shaping Hearts and Minds"</div>
        </div>
        <div style="text-align: right;">
            {{-- Language Switcher --}}
            <div style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px; display: inline-block;">
                <strong style="margin-right: 10px; opacity: 0.9;">{{ __('Language') }}:</strong>
                @if(App::getLocale() == 'en')
                    <a href="{{ url('/lang/en') }}" style="background: white; color: #4A90E2; padding: 8px 15px; border-radius: 20px; text-decoration: none; font-weight: 600; margin-right: 5px;">
                        🇬🇧 English
                    </a>
                    <a href="{{ url('/lang/pt') }}" style="color: white; padding: 8px 15px; border-radius: 20px; text-decoration: none; opacity: 0.7;">
                        🇵🇹 Português
                    </a>
                @else
                    <a href="{{ url('/lang/en') }}" style="color: white; padding: 8px 15px; border-radius: 20px; text-decoration: none; opacity: 0.7; margin-right: 5px;">
                        🇬🇧 English
                    </a>
                    <a href="{{ url('/lang/pt') }}" style="background: white; color: #4A90E2; padding: 8px 15px; border-radius: 20px; text-decoration: none; font-weight: 600;">
                        🇵🇹 Português
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- License Status Warning --}}
@php
    $license = DB::table('licenses')->where('is_active', true)->orderBy('expires_at', 'desc')->first();
    $daysRemaining = null;
    if($license && $license->expires_at) {
        $daysRemaining = \Carbon\Carbon::parse($license->expires_at)->diffInDays(now(), false);
    }
@endphp

@if($license)
    @if($daysRemaining !== null && $daysRemaining < 0)
        {{-- License Valid --}}
        @if(abs($daysRemaining) <= 30)
        <div class="license-warning">
            <h4><i class="glyphicon glyphicon-warning-sign"></i> <strong>License Expiring Soon</strong></h4>
            <p>Your license will expire in <strong>{{ abs($daysRemaining) }} days</strong> ({{ \Carbon\Carbon::parse($license->expires_at)->format('F d, Y') }}). Please renew to avoid service interruption.</p>
            <a href="{{ url('/license/settings') }}" class="btn btn-warning">
                <i class="glyphicon glyphicon-certificate"></i> Manage License
            </a>
        </div>
        @endif
    @elseif($daysRemaining >= 0)
        {{-- License Expired --}}
        <div class="license-warning danger">
            <h4><i class="glyphicon glyphicon-exclamation-sign"></i> <strong>License Expired</strong></h4>
            <p>Your license expired {{ $daysRemaining }} days ago. Please renew immediately to continue using the system.</p>
            <a href="{{ url('/license/settings') }}" class="btn btn-danger">
                <i class="glyphicon glyphicon-certificate"></i> Renew License Now
            </a>
        </div>
    @endif
@else
    <div class="license-warning danger">
        <h4><i class="glyphicon glyphicon-exclamation-sign"></i> <strong>No Active License</strong></h4>
        <p>No license found. Please activate a license to use the system.</p>
        <a href="{{ url('/license/settings') }}" class="btn btn-danger">
            <i class="glyphicon glyphicon-certificate"></i> Activate License
        </a>
    </div>
@endif

{{-- Key Statistics --}}
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card blue">
            <div class="stat-content">
                <div class="stat-number">{{ $total['student'] }}</div>
                <div class="stat-label">Active Students</div>
                <i class="glyphicon glyphicon-user stat-icon" style="color: #4A90E2;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="stat-card green">
            <div class="stat-content">
                <div class="stat-number">{{ $total['teacher'] }}</div>
                <div class="stat-label">Teachers</div>
                <i class="glyphicon glyphicon-education stat-icon" style="color: #50C878;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="stat-card orange">
            <div class="stat-content">
                <div class="stat-number">{{ $total['class'] }}</div>
                <div class="stat-label">Classes</div>
                <i class="glyphicon glyphicon-home stat-icon" style="color: #FFA500;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="stat-card purple">
            <div class="stat-content">
                <div class="stat-number">3</div>
                <div class="stat-label">Curricula</div>
                <i class="glyphicon glyphicon-book stat-icon" style="color: #9B59B6;"></i>
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row">
    <div class="col-md-12">
        <h3 class="section-title">
            <i class="glyphicon glyphicon-flash"></i> {{ __('Quick Actions') }}
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="quick-action-card blue">
            <div class="quick-action-icon">
                <i class="glyphicon glyphicon-plus-sign"></i>
            </div>
            <div class="quick-action-title">{{ __('New Student Admission') }}</div>
            <p style="font-size: 14px; color: #7f8c8d;">{{ __('Enroll with curriculum selection') }}</p>
            <a href="{{ url('/student/create') }}" class="quick-action-btn blue">
                <i class="glyphicon glyphicon-arrow-right"></i> {{ __('Admit Student') }}
            </a>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="quick-action-card green">
            <div class="quick-action-icon">
                <i class="glyphicon glyphicon-education"></i>
            </div>
            <div class="quick-action-title">{{ __('View Curricula') }}</div>
            <p style="font-size: 14px; color: #7f8c8d;">{{ __('Ambleside, Cambridge, Nacional') }}</p>
            <a href="{{ url('/curriculum') }}" class="quick-action-btn green">
                <i class="glyphicon glyphicon-arrow-right"></i> {{ __('View Curricula') }}
            </a>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="quick-action-card orange">
            <div class="quick-action-icon">
                <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="quick-action-title">{{ __('Family Management') }}</div>
            <p style="font-size: 14px; color: #7f8c8d;">{{ __('Manage family groups & siblings') }}</p>
            <a href="{{ url('/family/list') }}" class="quick-action-btn" style="background: #FFA500; color: white;">
                <i class="glyphicon glyphicon-arrow-right"></i> {{ __('View Families') }}
            </a>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="quick-action-card purple">
            <div class="quick-action-icon">
                <i class="glyphicon glyphicon-certificate"></i>
            </div>
            <div class="quick-action-title">{{ __('License Settings') }}</div>
            <p style="font-size: 14px; color: #7f8c8d;">{{ __('Manage subscription') }}</p>
            <a href="{{ url('/license/settings') }}" class="quick-action-btn" style="background: #9B59B6; color: white;">
                <i class="glyphicon glyphicon-arrow-right"></i> {{ __('Manage License') }}
            </a>
        </div>
    </div>
</div>

{{-- Beira Unida Custom Features --}}
<div class="row">
    <div class="col-md-12">
        <h3 class="section-title">
            <i class="glyphicon glyphicon-star"></i> {{ __('Beira Unida Custom Features') }}
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #4A90E2; margin-top: 0;">
                <i class="glyphicon glyphicon-barcode"></i> {{ __('Auto Student IDs') }}
            </h4>
            <p style="color: #7f8c8d; font-size: 14px;">
                {{ __('Format') }}: <strong>BCBA-YYYY-XXXX</strong><br>
                {{ __('Automatically generated for each student') }}
            </p>
            <a href="{{ url('/student/create') }}" class="btn btn-sm btn-primary">
                {{ __('Create Student') }} →
            </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #50C878; margin-top: 0;">
                <i class="glyphicon glyphicon-link"></i> {{ __('Family Grouping') }}
            </h4>
            <p style="color: #7f8c8d; font-size: 14px;">
                {{ __('Link siblings for consolidated billing and family discounts') }}
            </p>
            <a href="{{ url('/family/list') }}" class="btn btn-sm btn-success">
                {{ __('Manage Families') }} →
            </a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #9B59B6; margin-top: 0;">
                <i class="glyphicon glyphicon-globe"></i> {{ __('Bilingual System') }}
            </h4>
            <p style="color: #7f8c8d; font-size: 14px;">
                {{ __('English (UK) and Portuguese (Mozambique) interface') }}
            </p>
            <a href="{{ url('/lang/' . (App::getLocale() == 'en' ? 'pt' : 'en')) }}" class="btn btn-sm btn-default" style="background: #9B59B6; color: white;">
                {{ __('Switch Language') }} →
            </a>
        </div>
    </div>
</div>

{{-- Curriculum Overview & Today's Highlights --}}
<div class="row">
    <div class="col-md-6">
        <div class="curriculum-overview">
            <h3 class="section-title">
                <i class="glyphicon glyphicon-book"></i> {{ __('Curriculum Overview') }}
            </h3>
            
            @php
                $curriculums = \App\Models\Curriculum::with('subjects')->where('is_active', true)->get();
                $studentsByCurriculum = DB::table('Student')
                    ->select('curriculum_id', DB::raw('COUNT(*) as count'))
                    ->where('isActive', 'Yes')
                    ->whereNotNull('curriculum_id')
                    ->groupBy('curriculum_id')
                    ->get()
                    ->pluck('count', 'curriculum_id');
            @endphp
            
            @foreach($curriculums as $curriculum)
            <div class="curriculum-item">
                <div>
                    <div class="curriculum-name">
                        <i class="glyphicon glyphicon-education"></i> {{ $curriculum->name }}
                    </div>
                    <small style="color: #7f8c8d;">
                        {{ $curriculum->subjects->count() }} {{ __('subjects') }}
                        @if(isset($studentsByCurriculum[$curriculum->id]))
                            • {{ $studentsByCurriculum[$curriculum->id] }} {{ __('students') }}
                        @endif
                    </small>
                </div>
                <a href="{{ url('/curriculum/view/' . $curriculum->id) }}" class="btn btn-sm btn-primary">
                    <i class="glyphicon glyphicon-eye-open"></i> View
                </a>
            </div>
            @endforeach
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ url('/curriculum') }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-th-list"></i> {{ __('View All Curricula') }}
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="today-highlight">
            <h3 class="section-title">
                <i class="glyphicon glyphicon-calendar"></i> {{ __('Today\'s Highlights') }}
            </h3>
            
            <h4><i class="glyphicon glyphicon-time"></i> {{ __('Attendance Today') }}</h4>
            <div style="font-size: 16px; color: #2c3e50;">
                <strong style="color: #50C878;">{{ $total['student'] - $total['totalabsent'] }}</strong> {{ __('Present') }} • 
                <strong style="color: #DC3545;">{{ $total['totalabsent'] }}</strong> {{ __('Absent') }}
                @if($total['totallate'] > 0)
                    • <strong style="color: #FFA500;">{{ $total['totallate'] }}</strong> {{ __('Late') }}
                @endif
            </div>
            
            <hr>
            
            <h4><i class="glyphicon glyphicon-stats"></i> {{ __('Quick Stats') }}</h4>
            <ul style="list-style: none; padding: 0; font-size: 15px;">
                <li style="margin-bottom: 8px;">
                    <i class="glyphicon glyphicon-ok-sign" style="color: #50C878;"></i> 
                    {{ __('Active Session') }}: <strong>{{ get_current_session()->name ?? 'N/A' }}</strong>
                </li>
                <li style="margin-bottom: 8px;">
                    <i class="glyphicon glyphicon-folder-open" style="color: #4A90E2;"></i> 
                    {{ __('Total Subjects') }}: <strong>{{ $total['subject'] }}</strong>
                </li>
                <li style="margin-bottom: 8px;">
                    <i class="glyphicon glyphicon-calendar" style="color: #9B59B6;"></i> 
                    {{ __('Today') }}: <strong>{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</strong>
                </li>
            </ul>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd;">
                <h4 style="margin-bottom: 15px;">{{ __('All Beira Unida Features') }}</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 14px;">
                    <a href="{{ url('/curriculum') }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('Three Curricula') }}
                    </a>
                    <a href="{{ url('/student/create') }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('Auto Student IDs') }}
                    </a>
                    <a href="{{ url('/family/list') }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('Family Grouping') }}
                    </a>
                    <a href="{{ url('/license/settings') }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('License Management') }}
                    </a>
                    <a href="{{ url('/lang/' . (App::getLocale() == 'en' ? 'pt' : 'en')) }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('Bilingual Interface') }}
                    </a>
                    <a href="{{ url('/institute') }}" style="text-decoration: none; color: #4A90E2;">
                        ✓ {{ __('School Settings') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- System Information --}}
<div class="row">
    <div class="col-md-12">
        <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-align: center;">
            <p style="margin: 0; color: #7f8c8d;">
                <strong>{{ __('Beira Unida School Management System') }}</strong> • 
                {{ __('Powered by Charlotte Mason Philosophy') }} • 
                {{ __('Supporting Three Curricula') }}
            </p>
            <p style="margin: 10px 0 0 0; color: #95a5a6; font-size: 12px;">
                {{ __('Current Language') }}: <strong>{{ App::getLocale() == 'en' ? 'English (UK)' : 'Português (Moçambique)' }}</strong> • 
                <a href="{{ url('/lang/' . (App::getLocale() == 'en' ? 'pt' : 'en')) }}" style="color: #4A90E2;">
                    {{ __('Switch') }}
                </a>
            </p>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
// Any dashboard-specific JavaScript can go here
</script>
@stop

