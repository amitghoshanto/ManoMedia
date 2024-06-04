<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;
    protected $table = 'short_urls';

    public function visitcheck()
    {
        return $this->hasMany(ShortUrlVisit::class, 'short_url_id');
    }
}
