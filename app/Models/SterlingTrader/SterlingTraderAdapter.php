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
            'key' => md5(uniqid($this->id).time()),
            'secret' => sha1(uniqid($this->id).time()),
        ];
    }

    public function regenerateKeys()
    {
        $this->update($this->freshKeys());
    }

    public function activate()
    {
        $this->update(array_merge(['activated' => true], $this->freshKeys()));
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
