<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sow extends Model
{
    use HasFactory;
    protected $fillable = [
        'sow_no',
        'breed',
        'date_born',
        'origin',
        'dam',
        'date_procured',
        'sire'
    ];
}
