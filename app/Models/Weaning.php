<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weaning extends Model
{
    use HasFactory;
    protected $fillable = [
        'litter_no',
        'date',
        'number',
        'weight'
    ];
}
