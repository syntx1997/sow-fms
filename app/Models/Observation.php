<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    protected $fillable = [
        'pig_no',
        'treatment',
        'feed_amount',
        'feed_type',
        'start_weight',
        'end_weight',
        'status'
    ];
}
