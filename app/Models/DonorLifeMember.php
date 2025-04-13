<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorLifeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_type',
        'name',
        'fathers_name',
        'probashi',
        'phone_number',
        'email',
        'occupation',
        'reference',
        'address',
        'donation_payment_method',
        'transaction_id',
        'status',
    ];
}