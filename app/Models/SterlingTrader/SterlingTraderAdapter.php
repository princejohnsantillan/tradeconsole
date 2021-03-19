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

    public function scopeActive($query)
    {
        return $query->where('activated', true);
    }

    private function freshKeys()
    {
        return [
            'key' => hash('md5', uniqid($this->id).time()),
            'secret' => hash('sha256', uniqid($this->id).time()),
        ];
    }

    public function saveWithFreshKeys()
    {
        $freshKeys = $this->freshKeys();

        $this->key = $freshKeys['key'];

        $this->secret = $freshKeys['secret'];

        $this->save();
    }

    public function activate()
    {
        $this->activated = true;

        $this->saveWithFreshKeys();
    }

    public function deactivate()
    {
        $this->update(['activated' => false]);
    }

    public function setCapacity(int $limit)
    {
        $this->update(['capacity' => $limit]);
    }
}
