<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farrowing extends Model
{
    use HasFactory;
    protected $fillable = [
        'litter_no',
        'actual_date',
        'status',
        'weight',
        'foster',
        'sow'
    ];
}
