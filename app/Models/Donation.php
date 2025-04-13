<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Donation extends Model implements JWTSubject
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'donations';
    protected $fillable = [
        'donation_area_id',
        'donor_name',
        'donor_email',
        'donor_mobile',
        'amount',
        'address',
        'payment_gateway',
        'transaction_id',
        'status',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Get the donation area that owns the donation.
     */
    public function donationArea(): BelongsTo
    {
        return $this->belongsTo(DonationArea::class);
    }
}