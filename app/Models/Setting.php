<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'key'; // Use 'key' as the primary key
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Set the key type to string

    protected $fillable = [
        'key',
        'company_name',
        'address',
        'mobile',
        'website',
        'logo',
        'feature_image_1',
        'feature_image_2',
        'feature_image_3',
    ];
}