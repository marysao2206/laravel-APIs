<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'phone',
    ];

    public function generation()
    {
        return $this->belongsTo(Student::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Student::class, 'students');
    }
}
