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

    public function getEvent()
    {
        return array_key_exists('event', $this->message) ? $this->message['event'] : null;
    }

    public function getDataAsString()
    {
        return array_key_exists('data', $this->message) ? $this->message['data'] : null;
    }

    public function isEvent(string $event)
    {
        return $event === $this->getEvent();
    }
}
