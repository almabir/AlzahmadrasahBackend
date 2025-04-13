<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'fee_type', 'amount', 'payment_status', 
        'due_date', 'payment_date', 'payment_method', 'transaction_id'
    ];

    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
    ];

    // Relationship: A fee belongs to one student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Accessor: Get formatted amount
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' USD';
    }

    // Mutator: Ensure payment method is always stored in lowercase
    public function setPaymentMethodAttribute($value)
    {
        $this->attributes['payment_method'] = strtolower($value);
    }

    // Scope: Get only pending fees
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    // Scope: Get only paid fees
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}
