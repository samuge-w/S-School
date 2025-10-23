<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class License extends Model
{
    protected $fillable = [
        'license_key',
        'type',
        'issued_date',
        'expiry_date',
        'status',
        'school_id',
        'notes'
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Check if the license is active and valid
     */
    public function isValid(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->type === 'lifetime') {
            return true;
        }

        return $this->expiry_date && $this->expiry_date->isFuture();
    }

    /**
     * Get days until expiry
     */
    public function daysUntilExpiry(): ?int
    {
        if ($this->type === 'lifetime') {
            return null;
        }

        if (!$this->expiry_date) {
            return null;
        }

        return Carbon::now()->diffInDays($this->expiry_date, false);
    }

    /**
     * Check if license is expiring soon (within 30 days)
     */
    public function isExpiringSoon(): bool
    {
        $days = $this->daysUntilExpiry();
        return $days !== null && $days > 0 && $days <= 30;
    }

    /**
     * Activate the license based on its type
     */
    public function activate(): void
    {
        $this->issued_date = Carbon::now();
        $this->status = 'active';

        switch ($this->type) {
            case 'monthly':
                $this->expiry_date = Carbon::now()->addMonth();
                break;
            case 'yearly':
                $this->expiry_date = Carbon::now()->addYear();
                break;
            case '2year':
                $this->expiry_date = Carbon::now()->addYears(2);
                break;
            case 'lifetime':
                $this->expiry_date = null;
                break;
        }

        $this->save();
    }

    /**
     * Check and update license status
     */
    public function checkStatus(): void
    {
        if ($this->type !== 'lifetime' && $this->expiry_date && $this->expiry_date->isPast()) {
            $this->status = 'expired';
            $this->save();
        }
    }
}




