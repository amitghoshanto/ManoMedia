<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'fcm_history';

    // Define the fillable attributes
    protected $fillable = [
        'notification_key',
        'title',
        'icon',
        'image',
        'body',
        'short_url',
        'full_url',
        'click_count',
    ];
    public function shorturl_id()
    {
        return $this->belongsTo(ShortUrl::class, 'short_url', 'default_short_url')->with('visitcheck');
    }
}
