<?php

namespace App\Models\SterlingTrader;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SterlingTraderAdapter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'activated' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
