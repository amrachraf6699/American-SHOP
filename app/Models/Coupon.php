<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function discount($total)
    {
        if($this->type == 'fixed') {
            return $this->value;
        } else {
            return $total * $this->discount_percentage / 100;
        }
    }
    public function isValid()
    {
        // Check if the coupon is active
        if (!$this->is_active) {
            return false;
        }

        // Check if the coupon is time-limited and has expired
        if ($this->limit_type === 'time' && $this->expires_at && $this->expires_at <= now()) {
            return false;
        }

        // Check if the coupon is usage-limited and has exceeded its usage count
        if ($this->limit_type === 'usage' && $this->usage_count >= $this->max_usage) {
            return false;
        }

        // Check if discount amount or percentage is valid
        if (($this->type === 'fixed' && !$this->discount_amount) ||
            ($this->type === 'percentage' && !$this->discount_percentage)) {
            return false;
        }

        // If all conditions pass, the coupon is valid
        return true;
    }


    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];
}
