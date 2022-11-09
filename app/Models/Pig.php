<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pig extends Model
{
    use HasFactory;
    protected $fillable = [
        'pig_no',
        'breed',
        'date_born',
        'origin',
        'dam',
        'date_procured',
        'sire',
        'type',
        'photo'
    ];
}
