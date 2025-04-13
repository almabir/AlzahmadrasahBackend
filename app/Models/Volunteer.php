<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'probashi', 'phone_number', 'email', 'nid_number',
        'emergency_phone', 'facebook_id', 'occupation', 'volunteer_for', 
        'special_skill', 'permanent_district', 'permanent_address',
        'present_district', 'present_address'
    ];
}
