<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "comments";

    protected $fillable = [
        "message",
        "post_id",
        "parent_id",
        "user_id",
        "name",
        "email",
        "status",
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
