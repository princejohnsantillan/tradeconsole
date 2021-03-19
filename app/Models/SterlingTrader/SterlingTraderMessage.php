<?php

namespace App\Models\SterlingTrader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SterlingTraderMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'message' => 'array',
    ];

    public function adapter()
    {
        return $this->belongsTo(SterlingTraderAdapter::class);
    }

    public function getRawMessageAttribute()
    {
        return json_encode($this->message);
    }

    public function getFromMessage(string $key)
    {
        if (! is_array($this->message)) {
            return null;
        }

        return array_key_exists($key, $this->message) ? $this->message[$key] : null;
    }

    public function isEvent(string $event)
    {
        return $event === $this->getFromMessage('event');
    }
}
