<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BGD71D100 extends Model
{
    use HasFactory;
    protected $table = 'bg_d71_d100';
    protected $fillable = [
        'pig_id',
        'day',
        'time',
        'feed_amount',
        'feed_type'
    ];
}
