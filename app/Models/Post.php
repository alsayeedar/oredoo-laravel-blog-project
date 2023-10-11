<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "posts";
    protected $fillable = [
        "user_id",
        "title",
        "slug",
        "category_id",
        "content",
        "thumbnail",
        "views",
        "is_featured",
        "enable_comment",
        "status",
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'enable_comment' => 'boolean',
        'status' => 'boolean',
    ];
}
