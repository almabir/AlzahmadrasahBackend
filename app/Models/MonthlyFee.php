<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'amount', 'month', 'payment_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

