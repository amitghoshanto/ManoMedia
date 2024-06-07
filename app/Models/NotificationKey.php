<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationKey extends Model
{
    use HasFactory;
    protected $table = 'notification_key';

    protected $fillable = [
        'secret_key',
        'missed',
        'type',
        'country',
        'timezone',
        'device',
        'platform',
        'browser',
        'language',
        'ip',
    ];

    public function routeNotificationForFcm()
    {
        return $this->secret_key;
    }
}
