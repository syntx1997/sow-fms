<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BGD1D30 extends Model
{
    use HasFactory;
    protected $table = 'bg_d1_d30';
    protected $fillable = [
        'pig_id',
        'day',
        'time',
        'feed_amount',
        'feed_type'
    ];
}
