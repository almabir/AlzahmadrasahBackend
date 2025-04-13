<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'mobile', 'email', 'about', 'post', 
        'social_links', 'speech', 'cv', 'category'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
