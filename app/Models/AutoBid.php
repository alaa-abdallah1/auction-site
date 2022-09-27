<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoBid extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_auto_bid',
        'user_id',
        'item_id',
        'alert_when',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
