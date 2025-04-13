<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonationArea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'donationareas';
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * Get the donations for the donation area.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}