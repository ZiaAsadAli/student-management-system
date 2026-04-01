<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'program',
        'status',
        'gender',
        'date_of_birth',
        'address',
        'gpa',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'gpa'           => 'decimal:2',
    ];
}