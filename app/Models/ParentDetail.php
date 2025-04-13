<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentDetail extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'father_name', 'father_contact', 'mother_name', 'mother_contact'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
