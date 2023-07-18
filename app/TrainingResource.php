<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];
}
