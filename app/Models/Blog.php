<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'subcategory_id', 'title', 'slug', 'content', 'preview_image', 'author'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(BlogSubcategory::class, 'subcategory_id');
    }
}
