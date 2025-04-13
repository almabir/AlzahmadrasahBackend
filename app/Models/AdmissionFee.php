<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionFee extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'amount', 'payment_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

