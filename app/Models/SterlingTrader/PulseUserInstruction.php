<?php

namespace App\Models\SterlingTrader;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulseUserInstruction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'activated' => 'bool',
        'instruction' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('activated', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('activated', false);
    }
}
