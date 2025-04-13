<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalGuardian extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'name', 'relation', 'contact', 'address'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
