<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'mobile', 'dob', 'class_id', 'address', 'city', 'state', 'zip_code', 'profile_image'
    ];

    public function class()
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function parentDetails()
    {
        return $this->hasOne(ParentDetail::class);
    }

    public function localGuardian()
    {
        return $this->hasOne(LocalGuardian::class);
    }
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
    public function monthlyFees()
    {
        return $this->hasMany(MonthlyFee::class);
    }
}
