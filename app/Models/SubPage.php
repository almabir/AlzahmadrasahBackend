<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'title',
        'description',
        'thumbnail',
        'slug',
        'status',
    ];

    // Relationship: A SubPage belongs to a Page
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
