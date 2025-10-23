@extends('layouts.master')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">{{ __('messages.license_settings') }}</strong>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            @if($license && $license->isValid())
                                <div class="alert alert-info">
                                    <h4>{{ __('messages.active_license') }}</h4>
                                    <p><strong>{{ __('messages.license_type') }}:</strong> {{ ucfirst($license->type) }}</p>
                                    <p><strong>{{ __('messages.issued_date') }}:</strong> {{ $license->issued_date->format('d M Y') }}</p>
                                    @if($license->type !== 'lifetime')
                                        <p><strong>{{ __('messages.expiry_date') }}:</strong> {{ $license->expiry_date->translatedFormat('d M Y') }}</p>
                                        <p><strong>{{ __('messages.days_remaining') }}:</strong> {{ $license->daysUntilExpiry() }} {{ __('messages.days') }}</p>
                                        
                                        @if($license->isExpiringSoon())
                                            <div class="alert alert-warning mt-3">
                                                <i class="fa fa-exclamation-triangle"></i> 
                                                {{ __('messages.license_expiring_soon') }}
                                            </div>
                                        @endif
                                    @else
                                        <p><strong>{{ __('messages.expiry_date') }}:</strong> {{ __('messages.lifetime') }}</p>
                                    @endif
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i class="fa fa-exclamation-circle"></i> {{ __('messages.no_active_license') }}
                                </div>
                            @endif

                            <div class="card mt-4">
                                <div class="card-header">
                                    <strong>{{ __('messages.activate_license') }}</strong>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('license/activate') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="license_key">{{ __('messages.license_key') }}</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="license_key" 
                                                   name="license_key" 
                                                   placeholder="BCBA-XXXXXXXXXXXX"
                                                   required>
                                            <small class="form-text text-muted">
                                                {{ __('messages.license_key_help') }}
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-key"></i> {{ __('messages.activate') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if(Session::get('userRole') == 'Director')
                            <div class="card mt-4">
                                <div class="card-header">
                                    <strong>{{ __('messages.generate_license') }} (Admin Only)</strong>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('license/generate') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="type">{{ __('messages.license_type') }}</label>
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly" selected>Yearly</option>
                                                <option value="2year">2 Years</option>
                                                <option value="lifetime">Lifetime</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="school_id">School ID (Optional)</label>
                                            <input type="text" class="form-control" id="school_id" name="school_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="notes">Notes (Optional)</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus"></i> {{ __('messages.generate') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




