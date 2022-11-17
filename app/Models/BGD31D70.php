<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BGD31D70 extends Model
{
    use HasFactory;
    protected $table = 'bg_d31_d70';
    protected $fillable = [
        'pig_id',
        'day',
        'time',
        'feed_amount',
        'feed_type'
    ];
}
