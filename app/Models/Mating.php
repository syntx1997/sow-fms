<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mating extends Model
{
    use HasFactory;
    protected $fillable = [
        'litter_no',
        'date',
        'boar'
    ];
}
