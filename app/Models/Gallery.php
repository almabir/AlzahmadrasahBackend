<?php

// In App\Models\Gallery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;
    // protected $table = 'galleries';
    protected $fillable = [
        'category',
        'image_url',
        'title',
    ];

    public function categoryName(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'category'); // Assuming 'category_id' is your foreign key
    }
}